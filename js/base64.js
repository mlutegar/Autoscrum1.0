$('#capaId').on('change', function(){
    var reader = new FileReader();
    var svgTag = document.getElementsByTagName('svg')[0];

    if(svgTag != null) {
        var imgTag = document.createElement('img');

        imgTag.setAttribute('id', 'imgCapa');
        imgTag.setAttribute('alt', 'Sample photo');
        imgTag.setAttribute('class', 'img-fluid');
        imgTag.setAttribute('style', 'border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;');

        svgTag.parentNode.replaceChild(imgTag, svgTag);
    }

    reader.onloadend = function() {
        $('#imgCapa').attr('src', reader.result);
    };
    reader.readAsDataURL(this.files[0]);
});
