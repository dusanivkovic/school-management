                    <div class="d-flex justify-content-between align-items-start">
                        <form action="./?admin" class="forms-sample" method="POST" enctype="multipart/form-data">
                            <h5>Uvezi podatke</h5>
                            <div class="form-group">
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text py-3"><i class="ti-upload btn-icon-prepend"></i></span>
                                    </div>
                                    <input type="file" name="import-file" class="form-control py-3">
                                </div>
                                <button type="submit" name="upload-btn" class="btn btn-primary btn-icon-text btn-sm">Upload</button>
                            </div>
                        </form>
                        <div class="d-flex flex-column ms-1">
                            <h5 class="font-weight-bold mb-0">Export</h5>
                            <form action="./?admin" method="POST">
                                <input name="termin" type="hidden" value="">
                                <button type="submit" class="btn btn-secondary btn-icon-text btn-sm mb-1">
                                    <i class="ti-clipboard btn-icon-prepend"></i>Termini
                                </button>
                            </form>
                            <a href="./?admin" type="button" class="btn btn-secondary btn-icon-text btn-sm mb-1">
                                <i class="ti-clipboard btn-icon-prepend"></i>Testovi
                            </a>
                        </div>
                    </div>