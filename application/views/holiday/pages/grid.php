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
					 { name: 'name', type: 'string'}
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
			    url: '<?=base_url()?>holiday/grid',
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
					  
					  <? if(EDIT==1){?>			 
					  { text: 'Edit', menu: false, datafield: 'Edit', align:'center', editable: false, sortable: false, width: 40, 
					  	cellsrenderer: function (row) {							
							editrow = row;
							var dataRecord = jQuery("#jqxgrid").jqxGrid('getrowdata', editrow);										 	
								return '<div style="text-align:center;  cursor:pointer" onclick="editt('+dataRecord.id+','+editrow+','+dataRecord.sts+')" ><img align="center" src="<?=base_url()?>images/edit.png"></div>';							
						  }
					  },
					  <? }?>
					  
					  { text: 'Name', datafield: 'name', editable: false, width: '150' }
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
    
    
    
    
    
	
	</div>	
</div>