{"version":3,"sources":["contenttypes.js"],"names":["BX","namespace","Report","VisualConstructor","Widget","Content","AmChart","options","Dashboard","apply","this","arguments","chartWrapper","create","style","height","getHeight","paddingTop","addCustomEvent","widget","delegate","data","isFilled","AmCharts","isReady","ready","makeChart","prototype","__proto__","constructor","render","jsDD","unregisterObject","getWidget","getWidgetContainer","makeDraggable","getHeadContainer","monthNames","shortMonthNames","m","push","message","toString","chart","prepareDataForAmChart","dataProvider","length","invalidateSize","PieDiagram","chartDiv","call","opacity","setTimeout","transition","bind","Funnel","paddingLeft","Activity","getCell","handlerClearCell","graph","VC","PopupWindowManager","closeAllPopups","graphContainer","ActivityTileWidget","renderTo","labelY","config","labelX","items","NumberBlock","Html","setColor","applyColor","backgroundColor","getColor","getWidgetWrapper","color","substring","isWidgetDarkMode","Utils","isDarkColor","classList","remove","add","GroupedDataGrid","htmlContentWrapper","parentNode","content","clientHeight"],"mappings":"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","file":"contenttypes.map.js"}