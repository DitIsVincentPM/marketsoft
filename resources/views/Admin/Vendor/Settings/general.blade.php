<form enctype="multipart/form-data" method="POST" action="{{ route('admin.settings.save') }}">
    <input hidden name="type" value="general"></input>
    @csrf
    <div class="card">
        <div class="card-header">
            General Settings
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <label for="exampleInputEmail1" class="form-label">Company Name</label>
                    <input type="text" class="form-control" name="companyname" value="{{ Settings::key('CompanyName')  }}">
                    <div class="form-text">Putt the name here the name that will show everywhere as you company name.</div>
                </div>
                <div class="col-sm-offset-2 col-sm-12"><br>
                    <label class="form-label">Company Logo</label>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="companylogo" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">{{ Settings::key('CompanyLogo') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-text">This will be your logo that will be used in the navbar.</div>
                </div>
                <div class="col-sm-offset-2 col-sm-12"><br>
                    <label class="form-label">Navbar Icon</label>
                    <div class="form-group">
                        <div class="input-group">
                            <select name="navbaricon" class="form-control">
                                <option @if(Settings::key('NavbarIconStatus') == 0) selected @endif value="0">Company Name</option>
                                <option @if(Settings::key('NavbarIconStatus') == 1) selected @endif value="1">Company Logo</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-text">For turning on company logo or text.</div>
                </div>
                <div class="col-sm-offset-2 col-sm-12"><br>
                    <label class="form-label">Company Favicon</label>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="faviconlogo" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">{{ Settings::key('CompanyFavicon') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-text">This will be your logo that will be used in the navbar.</div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>