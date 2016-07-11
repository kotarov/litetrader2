<table class="dataTable uk-table uk-table-hover uk-table-striped" width="100%" 
                            data-ajax="<?=$url?>" 
                            data-dom="ltip"
                            data-sort="false"
                        >
                            <thead><tr> 
                                <th data-data="status" data-render="'<span title=\''+r.status_history.replace(/\,/g,'\n')+'\'>'+d+'</span>'">Статус</th>
                                <th data-data="id" data-class="uk-text-center" data-width="1em">No</th>
                                <th data-data="date" data-lang>Дата</th>
                                <th data-data="phone" data-lang>Телефон</th>
                                <th data-data="email" data-lang>Поща</th>
                                <th data-data="partner" data-lang>Име</th>
                                <th data-data="address" data-lang>Адрес</th>
                                <th data-data="payment_method" data-lang>Плащане</th>
                                <th data-data="products" data-class="uk-text-center" data-render="'<a data-cart=\''+r['id']+'\' class=\'uk-icon-shopping-cart\'><span class=\'uk-badge\'>'+d+'</span></a>'" data-lang></th>
                                <th data-data="total" data-class="uk-text-right uk-text-bold" data-render="parseFloat(d).toFixed(2,10)" data-lang>Сума</th> 
                            </tr></thead>
                            <tbody><tr> <td colspan="4" class="uk-text-center uk-text-muted" data-lang>Нямате нови заявки</td> </tr></tbody>
                        </table>