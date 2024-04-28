
<script type="text/javascript" src="<?=base_url()?>ckeditor/ckeditor.js"></script>
<style>
	#editor{
		font-family: 'sutonnymj';

	}

	#cke_contents_editor {
  min-height: 600px!important;
}

</style>
<body style="height:94%;">

	<div style="height:30px;background-color:#185891;font-size:22px;padding:5px 0 0 10px;color:white">
	Auction Paper Notice Export
	</div>
	<div style="padding:10px 10px;">
		<span>Export Paper Notice:&nbsp;</span>
		<!--a href="<?php //echo base_url('auction/auction_memo_pdf/' . $id); ?>" target="_blank"><img align="center" src="<?php //echo base_url() ?>images/pdf_icon.gif"></a-->&nbsp;
		 <a href="#" onclick="Export2Word('element')"><img align="center" src="<?php echo base_url() ?>images/word_icon.gif"></a>
	</div>
	<div style="width:96%;margin: auto;paddding: 10px;">
		<form action="" method="post" enctype="multipart/form-data">
			<input type="hidden" class="txt_csrfname"  name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
			<input type="hidden" name="token" value="<?=$id?>">
			<textarea id="editor" name="paper" ><?php echo $result; ?></textarea>
			<br>
			<input type="submit" value="Save" id="sendButton" class="btn-small btn-small-normal enabledElem jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-normal jqx-fill-state-normal-energyblue" style="background-color: rgb(24, 88, 145); color: rgb(255, 255, 255); border-radius: 20px !important; height: 30px; width: 120px; font-family: sans-serif; font-size: 16px;" role="button" aria-disabled="false">

		</form>
</div>
</body>
<script>
	CKEDITOR.replace( 'editor' );

   /*ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );*/

</script>

<script>
    //$(document).ready(function(){
    //$("#ddd").click(function(){
     // $.ajax({url: "./getdata.php", success: function(result){
        //console.log(result);
       // $("#element").html(result);


    function Export2Word(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' ><head><meta charset='utf-8'><title>Export Paper Notice To Doc</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;
    //var html = preHtml+result+postHtml;

    var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
    });

    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);

    // Specify file name
    var filename = 'paper_notice';
    filename = filename?filename+'.doc':'document.doc';

    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;

        // Setting the file name
        downloadLink.download = filename;

        //triggering the function
        downloadLink.click();
    }

    document.body.removeChild(downloadLink);

//}
}
//});

</script>

<div style="display:none;">
<div id="element"><?php echo $result; ?></div>
</div>