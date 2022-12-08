function header(doc,empresa){
console.log(empresa);
doc.setFontSize(8);
doc.setFont("helvetica", "normal");
let text = empresa.direccion;
let textPostion = this.center(doc, text);
let indexY=25;
doc.text(text, 77, indexY);
text = "Télef. "+empresa.telefono+" WhatsApp:"+empresa.whatsapp;
textPostion = this.center(doc, text);
indexY+=5;
doc.text(text, 77, indexY);
text = empresa.correo;
textPostion = this.center(doc, text);
indexY+=5;
doc.text(text, 77, indexY);
text = empresa.sitio_web;
textPostion = this.center(doc, text);
indexY+=5;
doc.text(text, 77, indexY);
text = empresa.codigo_postal;
textPostion = this.center(doc, text);
indexY+=5;
doc.text(text, 77, indexY);
indexY+=7;
doc.setDrawColor(255, 157, 13);
doc.line(5, indexY, 205, indexY);
doc.line(75, 5, 75, 48);
doc.setDrawColor(0, 0, 0);
let image=new Image();
image.src=$("#logo_modal").attr("src");
console.log($("#logo_modal").attr("src"));
doc.addImage(image, 'PNG', 3, 3, 65, 40);

    return doc;
}
function getTimeV2() {
    var date = new Date();

    return GetFormattedDate(date);
}
function getTimeV3() {
    var date = new Date();

    return GetFormattedDate2(date);
}
function GetFormattedDate2(date) {
    var month = ("0" + (date.getMonth() + 1)).slice(-2);
    var day = ("0" + date.getDate()).slice(-2);
    var year = date.getFullYear();
    var hour = ("0" + date.getHours()).slice(-2);
    var min = ("0" + date.getMinutes()).slice(-2);
    var seg = ("0" + date.getSeconds()).slice(-2);
    return " " + day + "/" + month + "/" + year;
}
function GetFormattedDate(date) {
    var month = ("0" + (date.getMonth() + 1)).slice(-2);
    var day = ("0" + date.getDate()).slice(-2);
    var year = date.getFullYear();
    var hour = ("0" + date.getHours()).slice(-2);
    var min = ("0" + date.getMinutes()).slice(-2);
    var seg = ("0" + date.getSeconds()).slice(-2);
    return hour + ":" + min + " " + day + "-" + month + "-" + year;
}
function center(doc, text) {
    var textWidth =
        (doc.getStringUnitWidth(text) * doc.internal.getFontSize()) /
        doc.internal.scaleFactor;
    var textOffset = (doc.internal.pageSize.width - textWidth) / 2;
    return textOffset;
}
/*Método que agrega paginación al pdf */
function addFooters(doc) {
    const pageCount = doc.internal.getNumberOfPages();
    doc.setFont("helvetica", "italic");
    doc.setFontSize(8);
    for (var i = 1; i <= pageCount; i++) {
        doc.setPage(i);
        var pageHeight =
            doc.internal.pageSize.height || doc.internal.pageSize.getHeight();
        var pageWidth =
            doc.internal.pageSize.width || doc.internal.pageSize.getWidth();
        doc.text(
            "Página " + String(i) + " de " + String(pageCount),
            pageWidth / 2 - 8,
            pageHeight - 5,
            {
                align: "center",
            }
        );
    }
    return doc;
}