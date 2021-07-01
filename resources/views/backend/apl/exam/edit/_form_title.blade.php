<div class="tab-pane active" id="examPanel" role="tabpanel">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group @if($errors->has('product')) validated @endif">
                <label @if($errors->has('product')) class="text-danger" @endif>Exam For Which Product?<span style="color: red">*</span></label>
                <select name="product" id="product" class="form-control @if($errors->has('product')) is-invalid @endif kt-select2">
                    <option value="{{ $dataDb->product }}" selected>{{  $dataDb->singleProduct->name. ' ('.$dataDb->singleProduct->type.')' }}</option>
                </select>
                {!! $errors->first('product', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group @if($errors->has('title')) validated @endif">
                <label @if($errors->has('title')) class="text-danger" @endif>Title<span style="color: red">*</span></label>
                <input type="text" name="title" class="form-control @if($errors->has('title')) is-invalid @endif" id="title" placeholder="Enter Title" value="{{ $dataDb->title }}" autofocus>
                {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group @if($errors->has('desc')) validated @endif">
                <label @if($errors->has('desc')) class="text-danger" @endif>Description<span style="color: red">*</span></label>
                <textarea name="desc" id="desc" cols="24" rows="5" class="form-control @if($errors->has('desc')) is-invalid @endif">{!! $dataDb->desc !!}</textarea>
                {!! $errors->first('desc', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group @if($errors->has('visibility')) validated @endif">
                <label @if($errors->has('visibility')) class="text-danger" @endif>Visibility<span style="color: red">*</span></label>
                <select name="visibility" id="visibility" class="form-control @if($errors->has('visibility')) is-invalid @endif kt-select2">
                    <option value="publish" @if( $dataDb->visibility == 'publish') selected="selected" @endif >Publish</option>
                    <option value="private" @if( $dataDb->visibility == 'private') selected="selected" @endif >Private</option>
                </select>
                {!! $errors->first('visibility', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group @if($errors->has('price')) validated @endif">
                <label @if($errors->has('price')) class="text-danger" @endif>Price<span style="color: red">*</span></label>
                <input type="text" name="price" id="price" class="form-control @if($errors->has('price')) is-invalid @endif" placeholder="Enter Price" value="{{ str_replace(',', '', $dataDb->price ) }}">
                {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>

    </div>
</div>
