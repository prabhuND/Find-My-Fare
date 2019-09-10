{"version":3,"sources":["script.js"],"names":["Helper","context","urlParameters","getNode","role","this","querySelector","changeClass","node","className","mode","classList","add","remove","toggle","getPosition","el","pos","r","getBoundingClientRect","top","left","width","height","right","bottom","e","offsetTop","offsetLeft","offsetWidth","offsetHeight","root","document","documentElement","body","scrollTop","scrollLeft","i","hasOwnProperty","Math","round","addEventListener","eventName","handler","window","attachEvent","removeUrlParam","url","param","Object","prototype","toString","call","length","BX","util","remove_url_param","params","indexOf","substr","replace","RegExp","Template","createNode","templateName","cloneNode","createItemSimpleNode","text","children","textContent","createItemReplaceNode","textFrom","textTo","iconClass","childNode","createItemIconNode","Effect","shadowNode","edgeNode","classShadowShow","classShadowHide","classHighlight","init","highlight","isHighlight","preventDefault","stopPropagation","nodeName","parentNode","self","isShadowShowed","animateScrollTo","edgePos","setAttribute","setTimeout","duration","callback","pageYOffset","screenHeight","clientHeight","nodeTop","easing","start","finish","step","state","scrollTo","onFinish","options","requestAnimationFrame","delta","progress","pow","transition","startTimestamp","timer","timestamp","Selector","classClosed","classDisabled","attributeDisabled","isDisabled","getAttribute","changeDisabled","close","select","containerNode","innerHTML","appendChild","bind","contains","target","PhoneSelector","isInit","items","selectorNode","selectedNode","countPhone","countEmail","module","message","disable","forEach","addItem","enable","item","values","type","replaced","from","to","value","onClick","SourceSelector","parameter","current","changed","sources","Manager","getCurrentSource","code","name","concat","Viewer","updateLocation","hideClass","bodyClass","deviceActiveClass","mobile","container","frame","desktopBtn","mobileBtn","onChangeDevice","changeDisplay","show","isMobile","sourceCode","src","location","href","split","assign","classSwitchDown","status","connector","b24Tracker","Connector","addressee","webPacker","getAddress","responders","b24.portal.refresh","reload","request","opener","load","getElementById","margin","buttonClose","buttonSwitch","switch","fields","get","Instance","run","stop","isOnBottom","insertBefore","firstChild","set","Editor","Status","onEditorInit"],"mappings":"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","file":"script.map.js"}