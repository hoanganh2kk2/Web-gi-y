<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-0">Cấu hình SEO</h4>
    </div>
    <div class="card-body form-steps">
        <div class="tab-content p-0">
            <div class="row">
                <div class="col-xl-3 col-12">
                    @include('components.upload', ['name' => "seo_images", 'height' => 230, 'img' => show_img(@@$obj->seo->images, false)])
                </div>
                <div class="col-xl-9 col-12">
                    <div class="col-12 my-2">
                        <label class="form-label">Khoá chính</label>
                        <input name="seo_keyword" value="{{@$obj->seo->keyword}}" type="text" class="form-control" placeholder="Nhập từ khoá chính">
                    </div>
                    <div class="col-12 my-2">
                        <label class="form-label">Khoá phụ <span class="text-danger">(Lưu ý các khóa phụ cách nhau bởi dấu ",")</span></label>
                        <input name="seo_keyword_extra" value="{{@$obj->seo->keyword_extra}}" type="text" class="form-control" placeholder="Nhập từ khoá phụ">
                    </div>
                    <div class="col-12 my-2">
                        <label class="form-label">Tiêu đề SEO</label>
                        <input name="seo_title" value="{{@$obj->seo->title}}" type="text" class="form-control" placeholder="Nhập tiêu đề seo">
                    </div>
                </div>

                <div class="col-12">
                    <div class="col-12 my-2">
                        <label class="form-label">Mô tả ngắn </label> <span class="text-danger">(trung bình khoảng 268 từ)</span>
                        <textarea name="seo_description" class="form-control"  id="description_seo" cols="10" rows="5">{{@$obj->seo->description}}</textarea>
                    </div>
                </div>

                <div class="col-12 row">
                    <div class="col-xl-4 col-12 my-2">
                        <label class="form-label">Thuộc tính kiểu</label>
                        <input disabled name="seo_type" value="articles" type="text" class="form-control" placeholder="Thuộc tính">
                    </div>
                    <div class="col-xl-4 col-12 my-2">
                        <label class="form-label">Url</label>
                        <input disabled name="seo_url" value="https://xuongquatanginlogo.com/" type="text" class="form-control" placeholder="URL">
                    </div>
                    <div class="col-xl-4 col-12 my-2">
                        <label class="form-label">Url Canonical</label>
                        <input disabled name="seo_url_canonical" value="https://xuongquatanginlogo.com/" type="text" class="form-control" placeholder="URL Canonical">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>