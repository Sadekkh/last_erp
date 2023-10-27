   <form action="{{ route('whorkshops_store') }}" method="post">
       @csrf
       <div class="row">
           <div class="col">
               <div class="form-group">
                   <label for="recipient-name" class="col-form-label">{{ __('source') }}</label>
                   <select class="form-control selectpicker" id="source" name="source" data-live-search="true" required>
                       <option data-tokens="{{ __('insider') }}" value="insider">{{ __('insider') }}</option>
                       <option data-tokens="{{ __('outsider') }}" value="outsider">{{ __('outsider') }}</option>
                   </select>
               </div>
           </div>
           <div class="col">
               <div class="form-group">
                   <label for="recipient-name" class="col-form-label">{{ __('entry_state') }}</label>
                   <select class="form-control selectpicker" name="entry_state" data-live-search="true" required>
                       <option data-tokens="{{ __('normal') }}" value="normal">{{ __('normal') }}</option>
                       <option data-tokens="{{ __('picked_up') }}" value="picked_up">{{ __('picked_up') }}</option>
                   </select>
               </div>
           </div>

       </div>

       <div id="inside">
           <div class="row">
               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('truck') }}</label>
                       <div class="together">
                           <select class="form-control selectpicker" name="truck_id" data-live-search="true">
                               @foreach ($trucks as $d)
                                   <option data-tokens="{{ $d->model }},{{ $d->vin }}" value="{{ $d->id }}">{{ $d->model }},{{ $d->vin }}</option>
                               @endforeach
                           </select>
                           <button class="btn btn-warning" style="width: 24%" id="add-truck">{{ __('add_truck') }}</button>
                       </div>
                   </div>
               </div>
               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('trailer') }}</label>
                       <div class="together">
                           <select class="form-control selectpicker" name="truck_trailer_id" data-live-search="true">
                               @foreach ($trailer as $d)
                                   <option data-tokens="{{ $d->model }},{{ $d->vin }}" value="{{ $d->id }}">{{ $d->model }},{{ $d->vin }}</option>
                               @endforeach
                           </select>
                           <button class="btn btn-warning" style="width: 24%" id="add-trailer">{{ __('add_trailer') }}</button>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div id="add-truck-field" style="display: none;">
           <h5> {{ __('message.add_new_truck') }}</h5>
           <div class="row">

               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('truck_model') }}</label>
                       <input type="text" class="form-control" name="model">
                   </div>
               </div>
               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('year') }}</label>
                       <input type="text" class="form-control" name="year">
                   </div>
               </div>

               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('number_wheels') }}</label>
                       <input type="number" class="form-control" name="number_wheels">
                   </div>
               </div>
               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('oil_change') }}</label>
                       <input type="text" class="form-control" name="oil_change">
                   </div>
               </div>
               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('vin') }}</label>
                       <input type="text" class="form-control" name="vin">
                   </div>
               </div>
               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('mileage') }}</label>
                       <input type="text" class="form-control" name="mileage">
                   </div>
               </div>

           </div>
       </div>
       <div id="add-trailer-field" style="display: none;">
           <h5> {{ __('message.add_new_trailer') }}</h5>
           <div class="row">

               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('trailer_model') }}</label>
                       <input type="text" class="form-control" name="model1">
                   </div>
               </div>
               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('year') }}</label>
                       <input type="text" class="form-control" name="year1">
                   </div>
               </div>

               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('number_wheels') }}</label>
                       <input type="number" class="form-control" name="number_wheels1">
                   </div>
               </div>
               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('oil_change') }}</label>
                       <input type="text" class="form-control" name="number_wheels1">
                   </div>
               </div>
               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('vin') }}</label>
                       <input type="text" class="form-control" name="vin1">
                   </div>
               </div>
               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('mileage') }}</label>
                       <input type="text" class="form-control" name="mileage1">
                   </div>
               </div>

           </div>
       </div>

       <div class="row">
           <div class="col">
               <div class="form-group">
                   <label for="recipient-name" class="col-form-label">{{ __('driver') }}</label>
                   <div class="together">
                       <select class="form-control selectpicker" name="driver_id" data-live-search="true">
                           @foreach ($driver as $d)
                               <option data-tokens="{{ $d->{'name' . localePrefix()} }},{{ $d->cin }}" value="{{ $d->id }}">{{ $d->{'name' . localePrefix()} }},{{ $d->cin }}</option>
                           @endforeach
                       </select>
                       <button class="btn btn-warning" style="width: 24%" id="add-driver">{{ __('add_driver') }}</button>
                   </div>
               </div>
           </div>
           <div class="col">
               <div class="form-group">
                   <label for="recipient-name" class="col-form-label">{{ __('reason') }}</label>
                   <select class="form-control selectpicker" name="reason" data-live-search="true" required>
                       <option data-tokens="{{ __('regular') }}" value="regular">{{ __('regular') }}</option>
                       <option data-tokens="{{ __('broken') }}" value="broken">{{ __('broken') }}</option>
                       <option data-tokens="{{ __('other') }}" value="other">{{ __('other') }}</option>
                   </select>
               </div>
           </div>
       </div>

       <div id="add-driver-field" style="display: none;">
           <h5>{{ __('message.add_new_driver') }}</h5>

           <div class="row">
               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('cin') }}</label>
                       <input type="text" class="form-control" name="cin">
                   </div>
               </div>
               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('name_ar') }}</label>
                       <input type="number" class="form-control" name="name_ar">
                   </div>
               </div>
               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('name_en') }}</label>
                       <input type="number" class="form-control" name="name_en">
                   </div>
               </div>
               <div class="col">
                   <div class="form-group">
                       <label for="recipient-name" class="col-form-label">{{ __('phone') }}</label>
                       <input type="number" class="form-control" name="phone">
                   </div>
               </div>

           </div>
       </div>
       <div class="row">
           <div class="col">
               <div class="form-group">
                   <label for="recipient-name" class="col-form-label">{{ __('entry_time') }}</label>
                   <input type="datetime-local" id="cal" class="form-control" name="entry_time" required="">
               </div>
           </div>
           <div class="col">
               <div class="form-group">
                   <label for="recipient-name" class="col-form-label">{{ __('approximate_leaving_time') }}</label>
                   <input type="datetime-local" class="form-control" name="approximate_leaving_time">
               </div>
           </div>

       </div>
       <div class="row">
           <div class="col">
               <div class="form-group">
                   <label for="recipient-name" class="col-form-label">{{ __('complain') }}</label>
                   <input type="text" class="form-control" name="complain">
               </div>
           </div>


       </div>
       <button type="submit" class="btn btn-success">{{ __('save') }}</button>




   </form>
