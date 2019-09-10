{"version":3,"sources":["common.js"],"names":["BX","namespace","licensePopup","loader","loaderOverlay","loadLoaderExtension","Promise","resolve","Loader","loadExt","then","Voximplant","showLoader","create","props","className","document","body","appendChild","target","addClass","show","hideLoader","hide","removeClass","alert","title","text","popup","PopupWindow","closeIcon","closeByEsc","autoHide","titleBar","content","overlay","color","opacity","buttons","PopupWindowButton","id","message","events","click","close","onPopupClose","this","destroy","onPopupDestroy","confirm","PopupWindowButtonLink","setLicensePopup","dialogId","showLicensePopup","B24","licenseInfoPopup","hasOwnProperty","UserSelector","_id","_settings","_fieldId","_control","_currentUser","_componentName","_componentObj","_componentContainer","_serviceContainer","_zIndex","_isDialogDisplayed","_dialog","_inputKeyPressHandler","delegate","onInputKeyPress","prototype","initialize","settings","getSetting","type","isDomNode","addCustomEvent","window","onCustomEntitySelectorOpen","onCustomEntitySelectorClose","getId","name","defaultval","getSearchInput","getLabelNode","isOpened","open","objName","searchInput","unbind","proxy","search","bind","onSelect","setSelected","selected","getSelected","key","unselect","style","display","draggable","offsetLeft","offsetTop","zIndex","bindOptions","forceBindPosition","onPopupShow","onDialogShow","onDialogClose","onDialogDestroy","_onFocus","setPopupContainer","closeSiblings","siblings","items","k","control","fieldId","current","getCurrentValues","parentNode","removeChild","e","user","node","value","setData","closeAll","self"],"mappings":"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","file":"common.map.js"}