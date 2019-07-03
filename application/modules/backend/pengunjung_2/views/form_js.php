<script>
function foto_pengunjungHandler() {

	var oImage	= document.getElementById("preview_foto_pengunjung");
    var oFile = $(' #foto_pengunjung ')[0].files[0];
    $('  #error_foto_pengunjung  ').hide();
     
	var arr1 = new Array;
    arr1 = oFile.name.split('\\');
    var len = arr1.length;
    var img1 = arr1[len - 1];
    var filext = img1.substring(img1.lastIndexOf(".") + 1);

    
    var rFilter = /^(jpg|jpeg|png|jpg|jpeg|svg)$/i;

    if (! rFilter.test(filext)) {
        $(' #error_foto_pengunjung ').html('Tipe image TIDAK di ijinkan').show();
        $('#foto_pengunjung').replaceWith( $('#foto_pengunjung').val("") );
        $("#preview_foto_pengunjung").hide();
        return;
    }

   
    if (oFile.size > 10000 * 1024) {
        $(' #error_foto_pengunjung ').html('image size TERLALU BESAR').show();
        $('#foto_pengunjung').replaceWith( $('#foto_pengunjung').val("") );

        $("#preview_foto_pengunjung").hide();
        return;
    }else if(oFile.size < 10 * 1024){
        $(' #error_foto_pengunjung ').html('image size TERLALU KECIL').show();
        $('#foto_pengunjung').replaceWith( $('#foto_pengunjung').val("") );
        
        $("#preview_foto_pengunjung").hide();
        return;
    }

	
			
	var oFReader = new FileReader();
	oFReader.readAsDataURL(document.getElementById("foto_pengunjung").files[0]);

	oFReader.onload = function (oFREvent) {
		oImage.src = oFREvent.target.result;
		oImage.style.display="block";
		oImage.style.maxWidth = "200px";
		oImage.style.maxHeight ="145px";
	};
	
}
	
$(function () {
		
	$('#tgl_daftar').datepicker({
    	format: 'yyyy-mm-dd',
    	autoclose:true
    });

});
</script>




<!-- 

/* Generated via crud engine by indonesiait.com | 2019-07-02 08:02:01 */

-->