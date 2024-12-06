<form id="form" class="ui stackable grid form" style="display: none;">

  <div class="eight wide column">
    <div class="field required">
      <label>First Name</label>
      <div class="ui input">
        <input id="first_name" type="text" name="first_name" />
      </div>
    </div>
  </div>

  <div class="eight wide column">
    <div class="field required">
      <label>Last Name</label>
      <div class="ui linput">
        <input id="last_name" type="text" name="last_name" />
      </div>
    </div>
  </div>

  <div class="sixteen wide column">
    <div class="field required">
      <label>Business Email</label>
      <div class="ui input">
        <input id="email" type="email" name="email" />
      </div>
    </div>
  </div>

  <div class="sixteen wide column">
    <div class="field">
      <label>Phone</label>
      <div class="ui left labeled icon input">
        <input id="phone" type="text" name="phone" />
      </div>
    </div>
  </div>

  <div class="eight wide column">
    <div class="field required">
      <label>Country</label>
      <div class="ui input">
        <select id="custom-country" name="custom-country" class="ui fluid search selection dropdown">
          <option value="Argentina">Argentina</option>
          <option value="Australia">Australia</option>
          <option value="Austria">Austria</option>
          <option value="Belarus">Belarus</option>
          <option value="Belgium">Belgium</option>
          <option value="Brazil">Brazil</option>
          <option value="Bulgaria">Bulgaria</option>
          <option value="Canada">Canada</option>
          <option value="Chile">Chile</option>
          <option value="China">China</option>
          <option value="Croatia">Croatia</option>
          <option value="Czech Republic">Czech Republic</option>
          <option value="Denmark">Denmark</option>
          <option value="Estonia">Estonia</option>
          <option value="Finland">Finland</option>
          <option value="France">France</option>
          <option value="Germany">Germany</option>
          <option value="Hong Kong">Hong Kong</option>
          <option value="Hungary">Hungary</option>
          <option value="India">India</option>
          <option value="Indonesia">Indonesia</option>
          <option value="Ireland">Ireland</option>
          <option value="Israel">Israel</option>
          <option value="Italy">Italy</option>
          <option value="Japan">Japan</option>
          <option value="Korea">Korea</option>
          <option value="Liechtenstein">Liechtenstein</option>
          <option value="Luxembourg">Luxembourg</option>
          <option value="Malaysia">Malaysia</option>
          <option value="Mexico">Mexico</option>
          <option value="Netherlands">Netherlands</option>
          <option value="New Zealand">New Zealand</option>
          <option value="Norway">Norway</option>
          <option value="Philippines">Philippines</option>
          <option value="Poland">Poland</option>
          <option value="Portugal">Portugal</option>
          <option value="Romania">Romania</option>
          <option value="Russia">Russia</option>
          <option value="Singapore">Singapore</option>
          <option value="Slovakia">Slovakia</option>
          <option value="Slovenia">Slovenia</option>
          <option value="South Africa">South Africa</option>
          <option value="Spain">Spain</option>
          <option value="Sweden">Sweden</option>
          <option value="Switzerland">Switzerland</option>
          <option value="Taiwan">Taiwan</option>
          <option value="Thailand">Thailand</option>
          <option value="Turkey">Turkey</option>
          <option value="Ukraine">Ukraine</option>
          <option value="United Kingdom">United Kingdom</option>
          <option value="United States (USA)">United States (USA)</option>
          <option value="Vietnam">Vietnam</option>
          <option value="Other: Americas">Other: Americas</option>
          <option value="Other: Asia">Other: Asia</option>
          <option value="Other: Europe">Other: Europe</option>
        </select>
	  </div>
    </div>
  </div>

  <div class="eight wide column">
    <div class="field required">
      <label>Zip Code</label>
      <div class="ui left labeled icon input">
        <input id="postal_code" type="text" name="postal_code" />
      </div>
    </div>
  </div>

  <div class="sixteen wide column left aligned">

    <div class="inline field">
      <label>Please select the communications you would prefer to receive from us.
        <span>(Select all that apply. Once you have made your selection click 'Update Preferences' at the bottom of the page.)</span>
      </label>
    </div>

    <div class="inline field">
      <div class="ui checkbox">
        <input id="seasonal" name="communications" type="checkbox" tabindex="0" class="hidden" value="Seasonal Promotions">
        <label for="seasonal">Seasonal Promotions
          <span>(Receive seasonal offers and discount notifications)</span>
        </label>
      </div>
    </div>

    <div class="inline field">
      <div class="ui checkbox">
        <input id="products" name="communications" type="checkbox" tabindex="0" class="hidden" value="Product Updates & Alerts">
        <label for="products">Product Updates & Alerts
          <span>(Get the scoop on new releases and support topics)</span>
        </label>
      </div>
    </div>

    <div class="inline field">
      <div class="ui checkbox">
        <input id="newsletter" name="communications" type="checkbox" tabindex="0" class="hidden" value="Actify Newsletter">
        <label for="newsletter">Actify Newsletter
          <span>(Quarterly highlights - covering solution, company and customer stories)</span>
        </label>
      </div>
    </div>

    <div class="inline field">
      <div class="ui checkbox">
        <input id="webinars" name="communications" type="checkbox" tabindex="0" class="hidden" value="Webinars & Events">
        <label for="webinars">Webinars & Events
          <span>(Monthly invitations to Actify’s free online webinars and events)</span>
        </label>
      </div>
    </div>

    <div class="inline field">
      <div class="ui checkbox">
        <input id="pr" name="communications" type="checkbox" tabindex="0" class="hidden" value="PR & Marketing">
        <label for="pr">PR & Marketing
          <span>(Regular publications, solution tips & tricks and customer case studies)</span>
        </label>
      </div>
    </div>

  </div>

  <div class="sixteen wide column center aligned">
    <button id="EmmaSubmit" class="ui green button" type="submit">Save</button>
    <p>
      <br/>Communication frequency may vary, you can update your email preferences and unsubscribe at any time.</p>
    <div class="ui error message"></div>
  </div>

  <div class="sixteen wide column hidethis">
    <h3 class="ui dividing header">Hidden Fields</h3>
    <label>Member ID</label>
    <input id="id_member_id" type="text" name="member_id" />
    <label>Source</label>
    <input id="id_source" type="text" name="source" />
  </div>
</form>