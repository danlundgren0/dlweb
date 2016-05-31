#/srv/sites/bergwall.se/web/typo3conf/ext/dl_bergwalltmpl
mod.wizards {
    newContentElement {
        wizardItems {
            dan {
                header = LLL:EXT:dl_bergwalltmpl/Resources/Private/Language/Backend.xlf:theme_name
                elements {
                    button {
                        icon = ../typo3conf/ext/dl_bergwalltmpl/Resources/Public/Images/ContentWizard/btn.png
                        title = LLL:EXT:dl_bergwalltmpl/Resources/Private/Language/Backend.xlf:content_element.button
                        description = LLL:EXT:dl_bergwalltmpl/Resources/Private/Language/Backend.xlf:content_element.button.description
                        tt_content_defValues {
                            CType = dl_bergwalltmpl_button
                        }
                    }
                }
                show = *
            }
        }
    }
}
