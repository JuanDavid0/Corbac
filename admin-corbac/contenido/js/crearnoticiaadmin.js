function crearUrl(cadena) {
    document.getElementById('inputNoticiaUrl').value = normalizar(cadena);
}
var normalizar = (function () {
    var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç",
            to = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc",
            mapa = {};
    for (var i = 0, j = from.length; i < j; i++)
        mapa[ from.charAt(i) ] = to.charAt(i);
    return function (str) {
        var cadenaFinal = [];
        for (var i = 0, j = str.length; i < j; i++) {
            var c = str.charAt(i);
            if (mapa.hasOwnProperty(str.charAt(i))) {
                cadenaFinal.push(mapa[ c ]);
            } else {
                cadenaFinal.push(c);
            }
        }
        return cadenaFinal.join('').replace(/[^-A-Za-z0-9]+/g, '-').toLowerCase();
    };
})();