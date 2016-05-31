######################################
#### BACKENDLAYOUT: SPECIAL START ####
######################################
#/srv/sites/bergwall.se/web/typo3conf/ext/dl_bergwalltmpl/Configuration/PageTS/Mod/WebLayout
mod {
    web_layout {
        BackendLayouts {
            bergwall_start {
                title = LLL:EXT:dl_bergwalltmpl/Resources/Private/Language/Backend.xlf:backend_layout.bergwall_start
                config {
                    backend_layout {
                        colCount = 4
                        rowCount = 4
                        rows {
                            1 {
                                columns {
                                    1 {
                                        name = LLL:EXT:dl_bergwalltmpl/Resources/Private/Language/Backend.xlf:backend_layout.column.border
                                        colPos = 3
                                        colspan = 4
                                    }
                                }
                            }
                            2 {
                                columns {
                                    1 {
                                        name = LLL:EXT:dl_bergwalltmpl/Resources/Private/Language/Backend.xlf:backend_layout.column.normal
                                        colPos = 0
                                        colspan = 4
                                    }
                                }
                            }
                            3 {
                                columns {
                                    1 {
                                        name = LLL:EXT:dl_bergwalltmpl/Resources/Private/Language/Backend.xlf:backend_layout.column.middle1
                                        colPos = 20
                                    }
                                    2 {
                                        name = LLL:EXT:dl_bergwalltmpl/Resources/Private/Language/Backend.xlf:backend_layout.column.middle2
                                        colPos = 21
                                    }
                                    3 {
                                        name = LLL:EXT:dl_bergwalltmpl/Resources/Private/Language/Backend.xlf:backend_layout.column.middle3
                                        colPos = 22
                                    }
                                    4 {
                                        name = LLL:EXT:dl_bergwalltmpl/Resources/Private/Language/Backend.xlf:backend_layout.column.middle4
                                        colPos = 23
                                    }
                                }
                            }
                            4 {
                                columns {
                                    1 {
                                        name = LLL:EXT:dl_bergwalltmpl/Resources/Private/Language/Backend.xlf:backend_layout.column.footer1
                                        colPos = 10
                                        colspan = 2
                                    }
                                    2 {
                                        name = LLL:EXT:dl_bergwalltmpl/Resources/Private/Language/Backend.xlf:backend_layout.column.footer2
                                        colPos = 11
                                        colspan = 2
                                    }
                                }
                            }
                        }
                    }
                }
                icon = EXT:dl_bergwalltmpl/Resources/Public/Images/BackendLayouts/special_start.gif
            }
        }
    }
}