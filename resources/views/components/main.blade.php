  <button class="btn btn-info" id="print_this">{{ __('print') }}</button>

  <div class="row gutters">

      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="accordion toggle-icons" id="toggleIcons">
              <div class="accordion-container">
                  <div class="accordion-header" id="toggleIconsOne">
                      <a href="" class="" data-toggle="collapse" data-target="#toggleIconsCollapseOne" aria-expanded="true" aria-controls="toggleIconsCollapseOne">
                          {{ __('details') }}
                      </a>
                  </div>
                  <div id="toggleIconsCollapseOne" class="collapse show" aria-labelledby="toggleIconsOne" data-parent="#toggleIcons">
                      <div class="accordion-body">
                          <div class="row">
                              <div class="col-5">
                                  <form action="{{ route('update_maintenance') }}" method="post" enctype="multipart/form-data" id="maintenanceForm">
                                      <div class="row">
                                          <div class="col">
                                              <div class="form-group">
                                                  <label for="recipient-name" class="col-form-label">{{ __('code') }}</label>
                                                  <select class="form-control selectpicker" id="code" name="code" data-live-search="true">
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="col">
                                              <div class="form-group">
                                                  <label for="recipient-name" class="col-form-label">{{ __('diag_emp') }}</label>
                                                  <select class="form-control selectpicker" id="diag_emp" name="diag_emp" data-live-search="true">
                                                  </select>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col">
                                              <label for="recipient-name" class="col-form-label">{{ __('mileage') }}</label>
                                              <input type="text" id="mileage2" name="mileage2" class="form-control">
                                          </div>
                                          <div class="col">
                                              <label for="recipient-name" class="col-form-label">{{ __('approximate_leaving_time') }}</label>
                                              <input type="date" id="approximate_leaving_time" name="approximate_leaving_time" class="form-control">

                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col">
                                              <label for="recipient-name" class="col-form-label">{{ __('leaving_time') }}</label>
                                              <input type="datetime-local" id="leaving_time" name="leaving_time" class="form-control">
                                          </div>
                                          <div class="col">
                                              <label for="recipient-name" class="col-form-label">{{ __('next_check') }}</label>
                                              <input type="date" id="next_check" name="next_check" class="form-control">
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col">
                                              <label for="recipient-name" class="col-form-label">{{ __('images') }}</label>
                                              <input type="file" class="form-control-file" name="image[]" multiple>
                                          </div>

                                          <div class="col">
                                              <br>
                                              <button id="serializeButton" class="btn btn-success">{{ __('save') }}</button>

                                          </div>
                                      </div>
                                  </form>

                                  <br><br>
                                  <form action="{{ route('savejob') }}" id="add_service" method="post">
                                      @csrf
                                      <input type="text" hidden id="maintenance_value" name="maintenance_order_id">
                                      <div class="row">
                                          <div class="col"><label for="recipient-name" class="col-form-label">{{ __('add_service') }}</label>
                                              <select class="form-control selectpicker" id="service" name="product_id" data-live-search="true">
                                              </select>
                                          </div>
                                          <div class="col">
                                              <label for="recipient-name" class="col-form-label">{{ __('worker') }}</label>
                                              <select class="form-control selectpicker" id="worker" name="worker_id" data-live-search="true">
                                              </select>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col">
                                              <label for="recipient-name" class="col-form-label">{{ __('description') }}</label>
                                              <input type="text" name="description" class="form-control">

                                          </div>
                                          <div class="col">
                                              <br>
                                              <button id="add_service_btn" class="btn btn-success">{{ __('save') }}</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                              <div class="col-7">
                                  <div class="table-responsive">
                                      <table id="copy-print-csv" class="table custom-table">
                                          <tr>
                                              <td></td>
                                              <td>{{ __('truck') }}</td>
                                              <td>{{ __('trailer') }}</td>
                                          </tr>
                                          <tr>
                                              <td>{{ __('model') }}</td>
                                              <td><input id="truck_model" disabled></td>
                                              <td><input id="trailer_model" disabled></td>
                                          </tr>
                                          <tr>
                                              <td>{{ __('year') }}</td>
                                              <td><input id="truck_year" disabled></td>
                                              <td><input id="trailer_year" disabled></td>
                                          </tr>
                                          <tr>
                                              <td>{{ __('mileage') }}</td>
                                              <td><input id="truck_mileage" disabled></td>
                                              <td>--</td>
                                          </tr>
                                          <tr>
                                              <td>{{ __('last_check') }}</td>
                                              <td><input id="truck_last_check" disabled></td>
                                              <td><input id="trailer_last_check" disabled></td>
                                          </tr>
                                          <tr>
                                              <td>{{ __('entry_time') }}</td>
                                              <td colspan="2"> <input id="entry_time" style="width: 100%" disabled></td>
                                          </tr>
                                          <tr>
                                              <td>{{ __('reason') }}</td>
                                              <td colspan="2"> <input id="reason" style="width: 100%" disabled></td>
                                          </tr>
                                          <tr>
                                              <td>{{ __('complain') }}</td>
                                              <td colspan="2"> <input id="complain" style="width: 100%" disabled></td>
                                          </tr>
                                          <tr>
                                              <td>{{ __('source') }}</td>
                                              <td colspan="2"> <input id="source" style="width: 100%" disabled></td>
                                          </tr>
                                          <tr>
                                              <td>{{ __('entry_state') }}</td>
                                              <td colspan="2"> <input id="entry_state" style="width: 100%" disabled></td>
                                          </tr>
                                      </table>
                                  </div>
                              </div>

                          </div>
                      </div>
                  </div>
              </div>
              <div class="accordion-container">
                  <div class="accordion-header" id="toggleIconsTwo">
                      <a href="" class="collapsed" data-toggle="collapse" data-target="#toggleIconsCollapseTwo" aria-expanded="false" aria-controls="toggleIconsCollapseTwo">
                          {{ __('services') }}
                      </a>
                  </div>
                  <div id="toggleIconsCollapseTwo" class="collapse" aria-labelledby="toggleIconsTwo" data-parent="#toggleIcons">
                      <div class="accordion-body">
                          <table id="serviceTable" class="table">
                              <thead>
                                  <tr>
                                      <th>{{ __('worker') }}</th>
                                      <th>{{ __('service') }}</th>
                                      <th>{{ __('entry_time') }}</th>
                                      <th>{{ __('leaving_time') }}</th>
                                      <th>{{ __('status') }}</th>
                                      <th>{{ __('description') }}</th>


                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
              <div class="accordion-container">
                  <div class="accordion-header" id="toggleIconsThree">
                      <a href="" class="collapsed" data-toggle="collapse" data-target="#toggleIconsCollapseThree" aria-expanded="false" aria-controls="toggleIconsCollapseThree">
                          {{ __('used_materials') }}
                      </a>
                  </div>
                  <div id="toggleIconsCollapseThree" class="collapse" aria-labelledby="toggleIconsThree" data-parent="#toggleIcons">
                      <div class="accordion-body">
                          <table id="materialtable" class="table">
                              <thead>
                                  <tr>
                                      <th>{{ __('product') }}</th>
                                      <th>{{ __('old_serial_num') }}</th>
                                      <th>{{ __('new_serial_num') }}</th>
                                      <th>{{ __('old_prod_desc') }}</th>
                                      <th>{{ __('oil_amount') }}</th>



                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>

  </div>
