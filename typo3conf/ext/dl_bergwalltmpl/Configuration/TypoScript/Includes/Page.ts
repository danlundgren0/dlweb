config.contentObjectExceptionHandler = 0
page = PAGE
page {
    typeNum = 0
    includeCSS {
        bergwall = EXT:dl_bergwalltmpl/Resources/Public/Css/Bergwalltmpl.css
        #bootstrapexternal = EXT:dl_bergwalltmpl/Resources/Public/Css/bootstrap.min.css
        #theme = EXT:dl_bergwalltmpl/Resources/Public/Css/bootstrap-theme.min.css
        #theme = EXT:dl_bergwalltmpl/Resources/Public/Less/Theme/theme.less
    }

    includeJSLibs {
        #modernizr = {$page.includePath.javascript}Libs/modernizr-2.8.3.min.js
    }

    includeJSFooterlibs {
        bootstrap >
        #jquery = {$page.includePath.javascript}Libs/jquery.min.js
        bottstrapCdn = https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js
        bottstrapCdn.external = 1
        #bottstrapCdn.integrity = sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS
        #bottstrapCdn.crossorigin = anonymous
    }

    jsFooterInline {

    }
    headerData {
    	10 = TEXT
    	10.value = <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,300italic' rel='stylesheet' type='text/css'>
        20 = TEXT
        20.value = <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        30 = TEXT
        30.value = <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    }
    10 = FLUIDTEMPLATE
    10 {
        templateName = TEXT
        templateName.stdWrap.cObject = CASE
        templateName.stdWrap.cObject {
            key.data = levelfield:-1, backend_layout_next_level, slide
            key.override.field = backend_layout

            pagets__bergwall_start = TEXT
            pagets__bergwall_start.value = BergwallStart

            #pagets__default = TEXT
            #pagets__default.value = Default

        }
        templateRootPaths {
            #0 = EXT:dl_bergwalltmpl/Resources/Private/Templates/Page/
            1 = {$page.fluidtemplate.templateRootPath}
        }
        partialRootPaths {
            #0 = EXT:dl_bergwalltmpl/Resources/Private/Partials/Page/
            1 = {$page.fluidtemplate.partialRootPath}
        }
        layoutRootPaths {
            #0 = EXT:dl_bergwalltmpl/Resources/Private/Layouts/Page/
            1 = {$page.fluidtemplate.layoutRootPath}
        }
    }
    includeJSFooterlibs {
        bergwall = EXT:dl_bergwalltmpl/Resources/Public/Js/bergwall_tmpl.js
    }
}
/srv/sites/bergwall.se/web/typo3conf/ext/dl_bergwalltmpl/Resources/Public/Css