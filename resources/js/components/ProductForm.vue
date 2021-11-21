<template>
  <div class="card card-info card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0 bg-transparent">
      <ul class="nav nav-tabs" id="steps" role="tablist">
        <li class="nav-item col-4 p-0">
          <a class="nav-link active" id="step-1" role="tab" aria-selected="true">
            Step 1 - Product Details
          </a>
        </li>
        <li class="nav-item col-4 p-0">
          <a class="nav-link disabled" id="step-2" role="tab" aria-selected="false">
            Step 2 - Product Images
          </a>
        </li>
        <li class="nav-item col-4 p-0">
          <a class="nav-link disabled" id="step-3" role="tab" aria-selected="false">
            Step 3 - Product Timestamp
          </a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content">
        <div id="step-1-content" class="tab-pane fade show active" role="tabpanel">
          <form @submit.prevent="validate(1)" class="mb-4 px-5 py-3 mx-5" novalidate="novalidate">
            <div class="form-group row">
              <label class="col-3 col-form-label" for="product-name">Product Name</label>
              <div class="col-9">
                <input id="product-name" type="text" class="pinput form-control" placeholder="" 
                  aria-describedby="name-error" aria-invalid="false"
                  v-model="product.name">
                <span id="name-error" class="error invalid-feedback" ></span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-3 col-form-label" for="product-name">Product Category</label>
              <div class="col-9">
                <input id="product-category" type="text" class="pinput form-control" placeholder="" 
                  v-model="product.category">
                <span id="category-error" class="error invalid-feedback" ></span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-3 col-form-label" for="summernote">Product Description</label>
              <div class="col-9">
                <textarea class="pinput" id="product-description" v-model="product.description">                Place &lt;em&gt;some&lt;/em&gt; &lt;u&gt;text&lt;/u&gt; &lt;strong&gt;here&lt;/strong&gt;
                </textarea>
                <span id="description-error" class="error invalid-feedback" style=""></span>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-flat float-right">Next</button>
            </div>
          </form>
        </div>
        <div id="step-2-content" class="tab-pane fade" role="tabpanel">
          <form @submit.prevent="validate(2)" class="mb-4 px-5 py-3 mx-5">
            <div class="form-group">
                <!-- <label for="customFile">Custom File</label> -->
                <div class="custom-file">
                  <input type="file" @change="fileChange" multiple class="custom-file-input" id="product-file"
                    aria-describedby="file-error" aria-invalid="true">
                  <label class="custom-file-label" for="product-file">Choose file</label>
                  <span id="file-error" class="error invalid-feedback" ></span>
                </div>

                <!-- @TODO fix container -->
                <a href="#" id="clone" class="d-none list-group-item list-group-item-action">No file selected</a>
                <div id="product-images-list" class="mt-3 list-group">
                  <a href="#" class="list-group-item list-group-item-action">No file selected.</a>
                  <a href="#" class="list-group-item list-group-item-action">No file selected.</a>
                  <a href="#" class="list-group-item list-group-item-action">No file selected.</a>
                  <a href="#" class="list-group-item list-group-item-action">No file selected.</a>
                  <a href="#" class="list-group-item list-group-item-action">No file selected.</a>
                </div>
              </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-flat float-right">Next</button>
            </div>
          </form>
        </div>
        <div id="step-2-content" class="tab-pane fade" role="tabpanel">
        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>
</template>

<script>

window.onload = function(){
  $('#product-description').summernote({
    height: 200,
  });
}

let p=window.product;

import datetime from 'vuejs-datetimepicker';

export default {
  components: {
    datetime
  },
  data(){
    return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      product: {
        id: p.pid,
        name: p.name,
        description: p.description,
        category: p.category,
        datetime: p.datetime,
        images: [],
      },
      product_id: '',
      pagination: {},
      edit: false
    }
  },
  methods: {
    fileChange(e){
      let files = e.target.files;
      if( this.product.images.length >= 5){
        alert("Only accept maximum of 5 per product");
      } else if( files.length + this.product.images.length > 5){
        alert("Please select max of " + (5-this.product.images.length) + " items");
      } else {
        for (let i = 0; i < files.length; i++){
          let f = files[i];
          if( f.size <= 3000000 || f.type == "image/png" || f.type == "image/jpeg" ){
            this.product.images.push(f);
          }
        }
      }
      this.displaySelectedImageFiles();
    },
    validate(step){
      if(step == 1){
        let htmlDesc = $("#product-description").summernote('code');
        this.product.description = htmlDesc == "<p><br></p>" ? "" : htmlDesc;
        
        fetch('/api/product/validate/nameCatDesc', {
          method: 'post',
          headers:{
            "Accept": "application/json",
            "Content-Type": "application/json",
            "Authorization": "Bearer 5|kRzviKkNqcxrBCEaoVEh2I60NzFbpsSKa5EMg4hr",
            'X-CSRF-TOKEN': this.csrf,
          },
          body: JSON.stringify(this.product)
        })
        .then(res => res.json())
        .then(data => {
          let errors = data.errors
          if(errors){
            let errorFields = Object.keys(data.errors)
            if( errorFields.length > 0 ){
              $(".pinput, .note-editor").removeClass("border border-danger is-invalid")
                console.log(errors)
              errorFields.forEach(f => {
                $("#product-"+f).addClass("is-invalid")
                $("#"+f+"-error").html(errors[f].join(", "));
                if(f == "description"){
                  $(".note-editor").addClass("border border-danger")
                }
              });
            }
          } else {
            $(".pinput, .note-editor").removeClass("border border-danger is-invalid")

            $("#step-"+step).removeClass("active").addClass("disabled");
            $("#step-"+(step+1)).removeClass("disabled").addClass("active");
            $("#step-"+step+"-content").removeClass("active show")
            $("#step-"+(step+1)+"-content").addClass("active show")
          }
        })
        .catch(error => console.log(error));
      } else if (step == 2){
        if( this.product.images.length == 0 ){
          console.log("no selection");
          $("#product-file").addClass("is-invalid")
          $("#file-errorr").html("Please select at least one file.");
        } else {
          $("#step-"+step).removeClass("active").addClass("disabled");
          $("#step-"+(step+1)).removeClass("disabled").addClass("active");
          $("#step-"+step+"-content").removeClass("active show")
          $("#step-"+(step+1)+"-content").addClass("active show")
        }
      }
    },
    displaySelectedImageFiles(){
      $("#product-file").removeClass("is-invalid")
      let pl = $("#product-images-list");
      let images = this.product.images;
      pl.html('');
      for(let i = 0; i < 5; i++){
        let c = $("#clone").clone();
        c.removeClass("d-none clone");
        if(typeof images[i] !== 'undefined'){
          c.html(images[i].name);
        } 
        pl.append(c);
      }
    },
    addProduct(){
      if(this.edit === false){
        // Add
        fetch('/api/product', {
          method: 'post',
          headers: { 
            "Accept": "application/json",
            "Content-Type": "application/json",
            "Authorization": "Bearer 5|kRzviKkNqcxrBCEaoVEh2I60NzFbpsSKa5EMg4hr",
            'X-CSRF-TOKEN': this.csrf,
          },
          body: JSON.stringify(this.product)
        })
        .then(res => res.json())
        .then(data => {
          // @TODO redirect
          alert('Product Created');
        })
        .catch(error => console.log(error));
      } else {
        // Edit
      }
    }
  },
  created() {
  },
}
</script>