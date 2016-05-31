#/srv/sites/bergwall.se/web/typo3conf/ext/dl_bergwalltmpl
page {
    fluidtemplate {
        # cat=dans package: advanced/100/100; type=string; label=Layout Root Path: Path to layouts
        layoutRootPath = EXT:dl_bergwalltmpl/Resources/Private/Layouts/Page/
        # cat=dans package: advanced/100/110; type=string; label=Partial Root Path: Path to partials
        partialRootPath = EXT:dl_bergwalltmpl/Resources/Private/Partials/Page/
        # cat=dans package: advanced/100/120; type=string; label=Template Root Path: Path to templates
        templateRootPath = EXT:dl_bergwalltmpl/Resources/Private/Templates/Page/
    }
}

#plugin.dl_bergwalltmpl {
#    settings {
        # cat=Dans template: advanced/190/100; type=boolean; label=Override LESS Variables: If enabled the variables defined in your LESS files will be overridden with the ones defined as TypoScript Constants.
#        overrideLessVariables = 1
        # cat=Dans package: advanced/190/110; type=boolean; label=CSS source mapping: Create a CSS source map useful to debug Less in browser developer tools. Note: CSS compression will be disabled.
#        cssSourceMapping = 0
#    }
#}

plugin.dl_bergwalltmpl_contentelements {
    view {
        # cat=Dans package: advanced/140/layoutRootPath; type=string; label=Layout Root Path: Path to layouts
        layoutRootPath = EXT:dl_bergwalltmpl/Resources/Private/Layouts/ContentElements/
        # cat=Dans package: advanced/140/partialRootPath; type=string; label=Partial Root Path: Path to partials
        partialRootPath = EXT:dl_bergwalltmpl/Resources/Private/Partials/ContentElements/
        # cat=Dans package: advanced/140/templateRootPath; type=string; label=Template Root Path: Path to templates
        templateRootPath = EXT:dl_bergwalltmpl/Resources/Private/Templates/ContentElements/
    }
}