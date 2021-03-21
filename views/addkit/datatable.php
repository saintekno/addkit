<script>
var DatatableScript = function() {   
    // Read
    var read = function() {
        var datatable = $('#kt_datatable').KTDatatable({
			data: {
				type: 'remote',
                source: '<?php echo site_url(['api', 'addkit']);?>',
				pageSize: 20, // display 20 records per page
			},

            // layout definition
            layout: {
                scroll: true, // enable/disable datatable scroll both horizontal and vertical when needed.
                height: true, // datatable's body's fixed height
                footer: false, // display/hide footer
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#search_query'),
                key: 'generalSearch'
            },  
            
            // columns definition
            columns: [
                {
                    field: 'id',
                    title: '#',
                    sortable: false,
                    width: 20,
                    type: 'number',
                    selector: {
                        class: ''
                    },
                    textAlign: 'center',
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
                        <?php if ( User::control('edit.addkit')) : ?>
						edit = '\
                            <a class="btn btn-sm btn-icon btn-light-primary btn-hover-primary "\
                                href="<?php echo site_url(array( 'admin', 'addkit', 'edit'));?>/'+ row.id +'">\
                                <i class="fas fa-pen"></i>\
                            </a>\
                        ';
                        <?php endif; ?>

                        <?php if ( User::control('delete.addkit')) : ?>
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
        });
        
        datatable.on(
            'datatable-on-check datatable-on-uncheck',
            function(e) {
                var checkedNodes = datatable.rows('.datatable-row-active').nodes();
                var count = checkedNodes.length;
                $('#kt_datatable_selected_records').html(count);
                if (count > 0) {
                    $('#kt_datatable_group_action_form').collapse('show');
                } else {
                    $('#kt_datatable_group_action_form').collapse('hide');
                }
            }
        );
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