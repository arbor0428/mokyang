<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>
<script language='javascript'>




oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);





<textarea name="ment" id="ment" style='width:100%;height:500px;'><?=$ment?></textarea>





 onClick='check_form();return false;'





<script type="text/javascript">

var oEditors = [];

nhn.husky.EZCreator.createInIFrame({

    oAppRef: oEditors,

    elPlaceHolder: "ment",

    sSkinURI: "/smarteditor/SmartEditor2Skin.html",

	/* 페이지 벗어나는 경고창 없애기 */
	htParams : {
		bUseToolbar : true,
		bUseVerticalResizer : false,
		fOnBeforeUnload : function(){},
		fOnAppLoad : function(){}
	}, 

    fCreator: "createSEditor2"

});

</script>
















<div style='width:800px;'><?=$ment?></div>