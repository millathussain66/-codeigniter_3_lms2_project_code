<div id="container">	
	<div id="body"  >
    <!--Customization Start-->
	<script type="text/javascript">
         jQuery(document).ready(function($) {
            // prepare the data
            var theme = 'classic';
      					
            var source =
            {
                 datatype: "json",
                 datafields: [
					 { name: 'id', type: 'int'},
					 { name: 'module_name', type: 'string'},
					 { name: 'total_rows', type: 'string'},
					 { name: 'file_name', type: 'string'},
					 { name: 'e_by', type: 'string'},
					 { name: 'e_dt', type: 'string'}
                ],
				addrow: function (rowid, rowdata, position, commit) {
                    commit(true);
                },
                deleterow: function (rowid, commit) {
                    commit(true);
                },
                updaterow: function (rowid, newdata, commit) {
                    commit(true);
                },
			    url: '<?=base_url()?>data_migration/grid',
				cache: false,
				filter: function()
				{
					// update the grid and send a request to the server.
					jQuery("#jqxgrid").jqxGrid('updatebounddata', 'filter');
				},
				sort: function()
				{
					// update the grid and send a request to the server.
					jQuery("#jqxgrid").jqxGrid('updatebounddata', 'sort');
				},
				root: 'Rows',
				beforeprocessing: function(data)
				{		
					if (data != null)
					{
						//alert(data[0].TotalRows)
						source.totalrecords = data[0].TotalRows;					
					}
				}
				
            };		
			
			
		    var dataadapter = new jQuery.jqx.dataAdapter(source, {
					loadError: function(xhr, status, error)
					{						
						alert(error);
					}
				}
			);
			
			
            jQuery("#jqxgrid").jqxGrid(
            {		
                width:'99%',
				height:350,
			    source: dataadapter,
                theme: theme,
				filterable: true,
				sortable: true,
				//autoheight: true,
				pageable: true,
				virtualmode: true,
				editable: true,
				enablehover: false,
                enablebrowserselection: true,
                selectionmode: 'none',
				rendergridrows: function(obj)
				{
					 return obj.data;    
				},
				
			    columns: [
                      { text: 'ID', datafield: 'id',hidden:true,  editable: false,  width: '45' },
					  { text: 'sts', datafield: 'sts',hidden:true,  editable: false,  width: '45' },
					  { text: 'Module Name', datafield: 'module_name', editable: false, width: '250' },
					  { text: 'DM File', editable: false, datafield: 'file_name', filterable: false,sortable: false, menu: false, width: 100, align: 'center', cellsalign: 'center',
						  	cellsrenderer: function (row){
						  		var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', row);	
						  		if (dataRecord.file_name!='' && dataRecord.file_name!=null) 
						  		{
						  			return ' <a href="<?=base_url()?>dm_files/'+dataRecord.file_name+'" download="'+dataRecord.file_name+'"> <div style=" margin-top: 5px; cursor:pointer;text-align:center" ><img src="<?=base_url()?>images/download_icon.png"></div></a>'
						  		}
						  		else
						  		{
						  			return '<div style=" margin-top: 5px; cursor:pointer;text-align:center"></div>';
						  		}
						  	}
						  },
					  { text: 'Entry By', datafield: 'e_by', editable: false, width: '200' },
					  { text: 'Entry Date Time', datafield: 'e_dt', editable: false, width: '200' },
					  { text: 'Total Rows', datafield: 'total_rows', editable: false, width: '80' }
                  ]
            });
		
		
		
				
			//jQuery("#sendButton").jqxButton({ theme: theme });			
						
        });
		
		
		function editt(val,indx)
		{
			jQuery("#jqxgrid").jqxGrid('clearselection');			
			EOL.messageBoard.open('<?=base_url()?>holiday/from/edit/'+val, (jQuery(window).width()-150), jQuery(window).height(), 'yes'); 			
			return false;			
		}
		
		
    </script>
    
    
    
    <div id="jqxgrid"  style=" margin: 10px auto"></div>
    
    <? if(ADD==1){?>
	<a style="text-decoration:none" onclick="javascript:EOL.messageBoard.open(this.href, (jQuery(window).width()-70), jQuery(window).height(), 'yes'); return false;"
    href="<?=base_url()?>index.php/data_migration/from/add" title=""><input type="button" class="buttonStyle" style="margin-left: 5px;background-color:#c2c2bc;font-size:13px;border-radius: 3px !important;height:40px;width:120px;"  value="Migrate Data" id="sendButton" /></a>
    <? }?> &nbsp;&nbsp
    
    
    
	
	</div>	
</div>