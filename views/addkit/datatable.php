<script>
var DatatableScript = function() {   
    // Read
    var read = function() {
        var datatable = $('#sit_datatable').SITDatatable({
			data: {
				type: 'remote',
                source: '<?php echo site_url(['api', 'addkit']);?>',
				pageSize: 20, // display 20 records per page
			},

            search: {
                input: $('#search_query'),
                key: 'generalSearch'
            },  
            
            // columns definition
            columns: [
                {
                    field: 'checkbox',
                    title: '',
                    template: '{{id}}',
                    sortable: false,
                    width: 20,
                    textAlign: 'center',
                    selector: {class: 'kt-checkbox--solid'},
                }, {
                    field: 'name',
                    title: 'Name',
                }, {
					field: 'Actions',
					title: 'Actions',
                    textAlign: 'right',
					sortable: false,
                    autoHide: false,
					overflow: 'visible',
                    width: 100,
					template: function(row) {
                        var edit  = '<button class="btn btn-light" disabled><i class="fas fa-pen"></i></button>';
                        var hapus = '<button class="btn btn-sm btn-icon btn-light" disabled><i class="fas fa-trash-alt"></i></button>';
                        <?php if ( User::is_allowed('update.addkit')) : ?>
						edit = '\
                            <a class="btn btn-sm btn-icon btn-light-primary btn-hover-primary "\
                                href="<?php echo site_url(array( 'admin', 'addkit', 'edit'));?>/'+ row.id +'">\
                                <i class="fas fa-pen"></i>\
                            </a>\
                        ';
                        <?php endif; ?>

                        <?php if ( User::is_allowed('delete.addkit')) : ?>
                        hapus = '\
                            <button class="btn btn-sm btn-icon btn-light-danger btn-hover-danger "\
                                data-head="<?php echo _s( 'Would you like to delete this data?' ) ;?>"\
                                data-url="<?php echo site_url(array( 'admin', 'addkit', 'delete'));?>/'+ row.id +'"\
                                onclick="deleteConfirmation(this)">\
                                <i class="fas fa-trash-alt"></i>\
                            </button>\
                        ';
                        <?php endif; ?>

                        return '<div class="btn-group">'+ edit +' '+ hapus +'</div>';
					},
				}
            ],

            translate: {
                records: {
                    noRecords: '<img class="w-150px mb-5" src="'+baseUrl+'assets/admin/img/svg/not_found.svg"/><br>'+
                    '<span class="text-uppercase font-weight-bold text-muted">WELL, BUDDY.</span> <br>'+
                    '<span>This space doesn\'t have a records so there\'s nothing to display here.</span>',
                }
            },
        });
    };

    return {
        init: function() {
            read();
        },
    };

}();

jQuery(document).ready(function() {
    DatatableScript.init();
});

</script>