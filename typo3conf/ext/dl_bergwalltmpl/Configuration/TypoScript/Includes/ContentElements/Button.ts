#///srv/sites/bergwall.se/web/typo3conf/ext/dl_bergwalltmpl/Configuration/TCA/Overrides
tt_content.dl_bergwalltmpl_button = COA
tt_content.dl_bergwalltmpl_button {
    10 =< lib.stdheader
    20 = FLUIDTEMPLATE
    20 {
        file = {$plugin.dl_bergwalltmpl_contentelements.view.templateRootPath}Button.html
        partialRootPath = {$plugin.dl_bergwalltmpl_contentelements.view.partialRootPath}
        layoutRootPath = {$plugin.dl_bergwalltmpl_contentelements.view.layoutRootPath}
    }
}