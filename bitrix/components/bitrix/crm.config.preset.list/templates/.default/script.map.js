{"version":3,"file":"script.min.js","sources":["script.js"],"names":["BX","namespace","Crm","PresetListManagerClass","settings","i","presetNames","presetName","this","type","isArray","length","prototype","getMessage","name","messages","addPreset","editPreset","presetId","parseInt","dlg","popup","popupId","elements","createNew","fixedPresetSelectWrapper","fixedPresetId","active","sort","handlers","fixedPresetSelectChange","presetData","NAME","ACTIVE","SORT","COUNTRY_ID","PopupWindow","overlay","opacity","autoHide","draggable","offsetLeft","offsetTop","bindOptions","forceBindPosition","closeByEsc","closeIcon","top","right","titleBar","events","onPopupShow","onPopupClose","delegate","unbind","destroy","onPopupDestroy","content","_preparePresetEditDialogContent","buttons","PopupWindowButton","text","className","click","_hanlePresetEditDialogSave","PopupWindowButtonLink","_hanlePresetEditDialogCancel","show","focus","_preparePresetEditDialogTitle","create","html","util","htmlspecialchars","props","tab","style","marginLeft","marginTop","marginRight","marginBottom","width","attrs","cellspacing","radioGroupId","appendChild","children","colspan","id","value","checked","_hanleCreateNewFlagSwitch","for","rebuildSelect","_hanleChangePresetSelection","bind","class","form","actionField","findChild","tag","attr","idField","createNewField","fixedPresetIdField","nameField","activeField","sortField","countryIdField","createNewInput","fixedPresetIdInput","nameInput","activeInput","sortInput","isNotEmptyString","alert","showWait","submit","close","display","isNaN","isString","select","items","opt","optIndex","el","j","setSelected","bMultiple","bGroup","curGroup","Array","getAttribute","lastChild","removeChild","document","createElement","label","innerHTML","selected","selectedIndex"],"mappings":"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"}