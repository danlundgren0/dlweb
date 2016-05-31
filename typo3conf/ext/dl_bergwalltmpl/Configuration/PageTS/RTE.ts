RTE.classes {
    btn-test {
        name = Button test
        requires = btn
    }
}
RTE.default.buttons {
    textstyle.tags.a {
        allowedClasses (
            btn, btn-test
        )
    }
}
RTE.default.proc {
    allowedClasses (
        btn, btn-test
    )
}
RTE.default.proc.entryHTMLparser_db = 1
RTE.default.proc.entryHTMLparser_db {
	a.fixAttrib.class.list = btn, btn-test
}
#RTE.default {
#    showButtons := addToList(user)
#}
#RTE.default {
#    userElements {
#        10 = My Special Tags
#        10 {
#            1 = Special day
#            1.description = The selected text is enclosed by
#            1.mode = wrap
#            1.content = <a href="#" class="btn btn-info" role="button">|</a>
#        }
#    }
#}
/*
RTE.default.proc {
	preserveDIVSections = 1
}
RTE.default.proc.entryHTMLparser_db = 1
RTE.default.proc.entryHTMLparser_db {
	tags {
		a.allowedAttribs = class, role
	}
}
*/
/*
RTE.default.proc.allowedClasses := addToList(testklasse)
RTE.default.classesLinks := addToList(testklasse)
RTE.default.classesAnchor := addToList(testklasse)
RTE.classesAnchor := addToList(testklasse)

RTE.classesAnchor.testklasse {
	class = testklasse
	type = page, url, mail, download
	titleText = Open Link
}

RTE.classesAnchor.testklasse.titleText = write your own title-text
RTE.classesAnchor.testklasse.altText = here is your alt-text

RTE.classesAnchor.emailAndEmailIcon {
	class = email emailIcon
	type = mail
	image = EXT:rtehtmlarea/res/accessibilityicons/img/mail.gif
	altText = LLL:EXT:rtehtmlarea/res/accessibilityicons/locallang.xml:mail_altText
	titleText = LLL:EXT:rtehtmlarea/res/accessibilityicons/locallang.xml:mail_titleText
}

RTE.default.classesAnchor := addToList(email emailIcon)

RTE.default {
	proc.allowedClasses := addToList(mylinkclass)
	buttons.link.properties.class.allowedClasses := addToList(mylinkclass)
}
*/