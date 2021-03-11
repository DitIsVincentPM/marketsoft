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
                    <label for="exampleInputEmail1" class="form-label">Company Logo</label>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" value="{{ Settings::key('CompanyLogo') }}" class="form-control" readonly>
                            <div class="input-group-btn">
                                <span class="fileUpload btn btn-primary">
                                    <span type="button" class="upl" id="upload">Upload</span>
                                    <input id="image" type="file" name="companylogo" class="upload up" accept='image/*' id="up" onchange="readURL(this);" />
                                </span>
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
                            <input type="text" value="{{ Settings::key('CompanyFavicon') }}" class="form-control" readonly>
                            <div class="input-group-btn">
                                <span class="fileUpload btn btn-primary">
                                    <span type="button" class="upl" id="upload">Upload</span>
                                    <input id="image" type="file" name="faviconlogo" class="upload up" accept='image/*' id="up" onchange="readURL(this);" />
                                </span>
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