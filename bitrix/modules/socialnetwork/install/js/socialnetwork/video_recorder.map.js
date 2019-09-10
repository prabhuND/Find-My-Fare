{"version":3,"sources":["video_recorder.js"],"names":["window","BX","VideoRecorder","popupPermissionsShown","popupConfirm","constraints","audio","video","width","height","facingMode","analyserNode","activeFormID","activeFormType","chunks","bindedForms","recorderInterval","transformLimit","transformTime","transformTimerShown","errorCode","reader","getScreenWidth","document","fullscreenElement","mozFullScreenElement","webkitFullscreenElement","body","clientWidth","screen","getScreenHeight","documentElement","clientHeight","isPermissionsAsked","isAvailable","report","error","navigator","mediaDevices","getUserMedia","MediaRecorder","browser","IsChrome","location","protocol","IsIE","console","log","bindEvents","handler","indexOf","params","formID","push","addCustomEvent","eventNode","file","controller","obj","blob","setTimeout","insertFile","id","i","controllers","hasOwnProperty","agent","onChange","showLayout","lockScroll","recordCount","startCount","state","transformTimeLeft","clearInterval","recordInterval","layout","create","props","className","children","events","click","hideLayout","videoOverlay","style","startTimer","text","videoContainer","videoWrap","waterMark","display","html","message","transformTimeContainer","hideTransformTimer","outputVideo","loop","playing","resize","beforeRecord","ended","buttonStop","buttonPlay","play","volume","panel","recordTimer","recorder","stop","hide","recordMark","analyzerElement","ajax","runAction","analyticsLabel","pause","buttonSave","fireEvent","File","date","format","convertBitrixFormat","hasTobeInserted","onCustomEvent","buttonCancel","buttonRestart","restartRecord","popupRecord","PopupWindow","zIndex","autoHide","closeByEsc","overlay","onPopupClose","this","destroy","onPopupDestroy","content","noAllPaddings","show","enterFullScreen","canvasContext","getContext","imageSmoothingEnabled","webkitImageSmoothingEnabled","addEventListener","addClass","attachAnalyzer","renderAnalyzer","nextSecond","clearTimeout","startTimeout","innerText","removeClass","startRecord","recordOptions","mimeType","isTypeSupported","stream","e","showMessage","start","recordSize","recordLength","ondataavailable","data","size","isTimeToShowTransformationAlert","startTransformationCounter","onstop","recordBlob","Blob","type","setSourceFromBlob","setVideoSrc","setInterval","getTimeString","audioContext","AudioContext","webkitAudioContext","createAnalyser","fftSize","minDecibels","maxDecibels","mediaStreamNode","createMediaStreamSource","connect","frequencyData","Uint8Array","frequencyBinCount","lastFrameDate","Date","getTime","requestAnimationFrame","bind","now","getByteFrequencyData","frequencyPoints","clearRect","beginPath","barWidth","barHeight","x","middlePoint","Math","ceil","fillStyle","round","fillRect","closePath","seconds","time","minutes","floor","formId","askDevicePermission","PopupWindowButton","PopupWindowButtonLink","popupWindow","close","then","catch","buttons","title","autohide","length","PreventDefault","delegate","titleBar","contentColor","cancelFullScreen","mozCancelFullScreen","webkitCancelFullScreen","remove","getVideoTracks","forEach","track","getAudioTracks","removeEventListener","unlockScroll","resultRelativeSize","videoRelativeSize","videoWidth","videoHeight","marginTop","marginLeft","setHeight","object","srcObject","derivative","showTransformTimer","transformTimer","classList","add","getReader","FileReader","onload","proxy","src","target","result","readAsDataURL"],"mappings":"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","file":"video_recorder.map.js"}