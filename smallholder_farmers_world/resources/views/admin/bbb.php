              <div class="controls">
                <input type="tel" name="phone_number" class="span11" placeholder="Enter Phone Number" />
              </div>


                            <div class="controls">
                <select name="users[]">
                  @foreach ($users as $user)
                  <option>{{$user->phone_number}}</option>
                  @endforeach
                </select>
              </div>