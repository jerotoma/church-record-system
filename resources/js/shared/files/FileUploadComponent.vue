<template>
 <div class="md-layout">
    <div class="md-layout-item">
       <div class="form-group">
           <label for="post-price" class="md-title">{{field_label}}</label>
        </div>
        <div class="file-upload-content" :style="media && media.id ? 'display:block' : 'display:none'">
            <span class="remove-image" v-on:click="removeUpload(media)"><i class="fa fa-times"></i></span>
            <img class="file-upload-image" :src="media && media.src ? getCdnUrl() + media.src : '#' " alt="" />
        </div>
        <div class="form-group image-upload-wrap" :style="media && media.id ? 'display:none' : 'display:block'">
            <input class="file-upload-input"
                    ref="fileUploadInput"
                    :name="inputName" type='file'
                    @change="readURL($event);"/>
            <div class="drag-text">
              <h3>{{ !turnOnDragAndDrop ? 'Click here to add file' : 'Drag and drop a file or Click here to add file'}}</h3>
            </div>
        </div>
    </div>
  </div>
</template>
<script>
import {mapState, mapGetters} from 'vuex';
export default {
    computed:{
		...mapGetters([

      ]),
    },
    props:{
      turnOnDragAndDrop:{
        type:Boolean,
        required:false,
        default:false,
      },
      inputName:{
        type:String,
        required:false,
        default:'mainImage',
      },
      media:{
        type:Object,
        required:false,
        default:function(){return null;},
      },
      btnTitle:{
        type:String,
        required:false,
        default:'Upload File',
      },
      field_label:{
        type:String,
        required:false,
        default:'Upload File',
      }
    },
    data(){
        return {
            imageUploadWrap:null,
            fileUploadContent:null,
            preview:null,
            file:null,
            fileName:null
        }
    },
    mounted(){
      this.preview = document.querySelector('img.file-upload-image');
      this.imageUploadWrap = document.querySelector('.image-upload-wrap');
      this.fileUploadContent= document.querySelector('.file-upload-content');
      if(this.turnOnDragAndDrop){
        this.activateDragAndDrop();
      }
    },
    methods:{
        triggerInputClick(){
             const elem = this.$refs.fileUploadInput;
             elem.click();
        },
        readURL(input) {
           console.log(input.target.files);
            if (input.target.files && input.target.files[0]) {
                let reader = new FileReader();
                this.file = input.target.files[0];
                this.fileName = input.target.files[0].name;
                reader.addEventListener('load', ()=>{
                    this.imageUploadWrap.style.display = 'none';
                    this.fileUploadContent.style.display = 'block';
                    this.preview.src = reader.result;
                    //this.imageTitle.innerHTML = this.fileName;
                }, false);

                if (this.file) {
                  reader.readAsDataURL(this.file);
                  this.$emit('onFileAdded', this.file);
                }
            } else {
                this.removeUpload();
            }
        },
        removeUpload(media) {
          if(media){
             this.$emit('onFileMediaDeleted', {});
           }
           this.preview.src = '';
           this.file = null;
           this.imageUploadWrap.style.display='block';
           this.fileUploadContent.style.display='none';
           this.$emit('onFileAdded', this.file);

        },
        activateDragAndDrop(){
           this.imageUploadWrap.addEventListener('dragover', (e)=>{
                e.preventDefault();
                e.stopPropagation();
                let arr, name;
                name = 'image-dropping';
                arr = this.imageUploadWrap.className.split(" ");
                if (arr.indexOf(name) == -1) {
                  this.imageUploadWrap.className += " " + name;
                }
            });
            this.imageUploadWrap.addEventListener('dragleave', (e)=>{
                this.imageUploadWrap.className = this.imageUploadWrap.className.replace(/\bimage-dropping\b/g, "");
            });
        }
    }
}
</script>
<style scoped>
.file-upload {
  background-color: #ffffff;
  width: 600px;
  margin: 0 auto;
  padding: 20px;
}
.file-upload-btn {
  width: 100%;
  margin: 0;
  color: #fff;
  background: #5cb85c;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #5cb85c;;
  transition: all .2s ease;
  outline: none;
  text-transform: normal;
  font-weight: 700;
}

.file-upload-btn:hover {
  background: #5cb85c;;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.file-upload-btn:active {
  border: 0;
  transition: all .2s ease;
}

.file-upload-content {
  display: none;
  text-align: center;
  border: #5cb85c;
  border-radius: 2.5px;
  position: relative;
  width: 50%;
  overflow: hidden;
  margin: 10px;
  display: inline-block;
}

.file-upload-input {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
}

.image-upload-wrap {
  margin-top: 20px;
  border: 4px dashed #5cb85c;
  position: relative;
}

.image-dropping,
.image-upload-wrap:hover {
  border: 4px dashed #5cb85c;
}

.image-title-wrap {
  padding: 0 15px 15px 15px;
  color: #222;
}

.drag-text {
  text-align: center;
}

.drag-text h3 {
  font-weight: 100;
  text-transform: normal;
  color: #5cb85c;
  padding: 60px 0;
}

.file-upload-image {
  max-height: 200px;
  max-width: 200px;
  margin: auto;
  padding: 20px;
}
span.remove-image{
  position: absolute;
  top: -5px;
  left: 0px;
  z-index: 100;
  padding: 0px 1px;
  border-radius: 2px;
  background-color:#d33333;
  cursor: pointer;
}
.fa.fa-times{
  color: #fff;
}
</style>


