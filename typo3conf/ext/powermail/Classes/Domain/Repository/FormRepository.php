<?php
namespace In2code\Powermail\Domain\Repository;

use In2code\Powermail\Domain\Model\Field;
use In2code\Powermail\Domain\Model\Form;
use In2code\Powermail\Domain\Model\Page;
use TYPO3\CMS\Core\Database\QueryGenerator;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 in2code GmbH <info@in2code.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * FormRepository
 *
 * @package powermail
 * @license http://www.gnu.org/licenses/lgpl.html
 *          GNU Lesser General Public License, version 3 or later
 */
class FormRepository extends AbstractRepository
{

    /**
     * Find Form objects by its given uids
     *
     * @param string $uids commaseparated list of uids
     * @return QueryResult
     */
    public function findByUids($uids)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false)->setRespectSysLanguage(false);

        $query->matching($query->in('uid', GeneralUtility::intExplode(',', $uids, true)));

        $result = $query->execute();
        return $result;
    }

    /**
     * Find Form by given Page Uid
     *
     * @param int $uid page uid
     * @return QueryResult
     */
    public function findByPages($uid)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false)->setRespectSysLanguage(false);

        $query->matching($query->equals('pages.uid', $uid));

        $result = $query->execute()->getFirst();
        return $result;
    }

    /**
     * Returns form with captcha from given UID
     *
     * @param Form $form
     * @return QueryResult
     */
    public function hasCaptcha(Form $form)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false)->setRespectSysLanguage(false);
        $and = [
            $query->equals('uid', $form->getUid()),
            $query->equals('pages.fields.type', 'captcha')
        ];
        $query->matching($query->logicalAnd($and));
        return $query->execute();
    }

    /**
     * Returns form with password from given UID
     *
     * @param Form $form
     * @return QueryResult
     */
    public function hasPassword(Form $form)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $and = [
            $query->equals('uid', $form->getUid()),
            $query->equals('pages.fields.type', 'password')
        ];
        $query->matching($query->logicalAnd($and));
        return $query->execute();
    }

    /**
     * This function is a workarround to get the field value of
     * "pages" in the table "forms"
     * (only relevant if IRRE was replaced by Element Browser)
     *
     * @param int $uid Form UID
     * @return string
     */
    public function getPagesValue($uid)
    {
        $query = $this->createQuery();

        // create sql statement
        $sql = 'select pages';
        $sql .= ' from ' . Form::TABLE_NAME;
        $sql .= ' where uid = ' . (int)$uid;
        $sql .= ' limit 1';

        $result = $query->statement($sql)->execute(true);

        return $result[0]['pages'];
    }

    /**
     * Find all and don't respect Storage
     *
     * @return QueryResult
     */
    public function findAll()
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        return $query->execute();
    }

    /**
     * Find all within a Page and its subpages
     *
     * @param int $pid
     * @return QueryResult
     */
    public function findAllInPid($pid)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);

        if ($pid > 0) {
            /** @var QueryGenerator $queryGenerator */
            $queryGenerator = GeneralUtility::makeInstance(QueryGenerator::class);
            $pidList = $queryGenerator->getTreeList($pid, 20, 0, 1);
            $query->matching($query->in('pid', GeneralUtility::trimExplode(',', $pidList, true)));
        }

        return $query->execute();
    }


    /**
     * Find all localized records with
     *        tx_powermail_domain_model_form.pages = ""
     *
     * @return mixed
     */
    public function findAllWrongLocalizedForms()
    {
        $query = $this->createQuery();

        $sql = 'select uid,pid,title';
        $sql .= ' from ' . Form::TABLE_NAME;
        $sql .= ' where pages = ""';
        $sql .= ' and sys_language_uid > 0';
        $sql .= ' and deleted = 0';
        $sql .= ' limit 1';

        $result = $query->statement($sql)->execute(true);

        return $result;
    }

    /**
     * Fix wrong localized forms
     *
     * @return void
     */
    public function fixWrongLocalizedForms()
    {
        $this->getDatabaseConnection()->exec_UPDATEquery(
            Form::TABLE_NAME,
            'sys_language_uid > 0 and deleted = 0 and pages = ""',
            ['pages' => 0]
        );
    }

    /**
     * @param $xmlArray
     * @param $key
     * @return string
     */
    protected function getFlexFormValue($xmlArray, $key)
    {
        if (is_array($xmlArray) && isset($xmlArray['data']['sDEF']['lDEF'][$key]['vDEF'])) {
            if (!empty($xmlArray['data']['sDEF']['lDEF'][$key]['vDEF'])) {
                return $xmlArray['data']['sDEF']['lDEF'][$key]['vDEF'];
            }
        }
        return '';
    }

    /**
     * Get Fieldlist from Form UID
     *
     * @param int $formUid Form UID
     * @return array
     */
    public function getFieldsFromFormWithSelectQuery($formUid)
    {
        $select = 'f.uid, f.title, f.sender_email, f.sender_name, f.marker';
        $from = Field::TABLE_NAME . ' f ' .
            'left join ' . Page::TABLE_NAME . ' p on f.pages = p.uid ' .
            'left join ' . Form::TABLE_NAME . ' fo on p.forms = fo.uid';
        $where = 'f.deleted = 0 and f.hidden = 0 and f.type != "submit" ' .
            'and f.sys_language_uid IN (-1,0) and fo.uid = ' . (int)$formUid;
        $groupBy = '';
        $orderBy = 'f.sorting ASC';
        $limit = 10000;
        $res = $this->getDatabaseConnection()->exec_SELECTquery($select, $from, $where, $groupBy, $orderBy, $limit);

        $array = [];
        if ($res) {
            while (($row = $this->getDatabaseConnection()->sql_fetch_assoc($res))) {
                $array[] = $row;
            }
        }

        return $array;
    }

    /**
     * Get Field Uid List from given Form Uid
     *
     * @param integer $formUid
     * @return array e.g. array(123, 234, 567)
     */
    public function getFieldUidsFromForm($formUid)
    {
        $fields = [];
        $form = $this->findByUid($formUid);
        if ($form !== null) {
            /** @var Page $page */
            foreach ($form->getPages() as $page) {
                /** @var Field $field */
                foreach ($page->getFields() as $field) {
                    if ($field->isAdvancedFieldType()) {
                        $fields[] = $field->getUid();
                    }
                }
            }
        }
        return $fields;
    }
}
