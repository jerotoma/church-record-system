<template>
  <section>
    <div class="row">
        <div class="col-md-12">
            <div class="pdf-main-container">
                <div 
                v-if="isShowPage"
                class="top-bar">
                    <span class="page-info push-right" v-if="pageCount != 0">
                        Page <span class="page-num">{{pageNum}}</span> of <span class="page-count">{{pageCount}}</span>
                    </span>
                    <button class="btn btn-sm push-right" @click.stop.prevent="onNextPage()"><i class="fa fa-arrow-circle-right"></i></button>
                    <button class="btn btn-sm push-right" @click.stop.prevent="onPrevPage()"><i class="fa fa-arrow-circle-left"></i></button>                                       
                </div>
                <canvas :id="'pdf-render-show'"></canvas>
            </div>
        </div>
    </div>    
  </section>
</template>
<script>
//import pdf from 'vue-pdf';
export default {
    props:{
        pdf_file:{
            required:true,
            type:Object
        },
        isShowPage:{
            required:false,
            type:Boolean,
            default:false
        }
    },
    data(){
        return {
            pdfDoc: null,
            scale:1.5,
            pageNum:1,
            pageCount: 0,
            pageRendering:false,
            pageNumPending:null,
            media:this.pdf_file,
           
        };
    },
    components: {
       
    },
    methods:{
        getCdnUrl(){
          return vimmak.cdnUrl;
        },
        renderPage(num){
            const canvas = document.querySelector("#pdf-render-show");
            const context = canvas.getContext('2d');
            if(this.pdfDoc){
                this.pageRendering = true;
                this.pdfDoc.getPage(num).then(page => {
                    var viewport = page.getViewport(this.scale);
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    var renderTask = page.render(renderContext);
                    renderTask.promise.then(() =>{
                    this.pageRendering = false;
                    if (this.pageNumPending !== null) {
                        // New page rendering is pending
                        this.renderPage(this.pageNumPending);
                        this.pageNumPending = null;
                    }
                    });
                }, (reason) => {
                // PDF loading error
                console.error(reason);
                }); 
           }
        },
        loadPdf(){
            var loadingTask = pdfjsLib.getDocument('http://localhost:8080/pdf/F000703770_PA.pdf');
            //var loadingTask = pdfjsLib.getDocument(this.getCdnUrl() + this.pdf_file.src);
            loadingTask.promise.then(_pdfDoc => {
            this.pdfDoc = _pdfDoc;
            this.pageCount = this.pdfDoc.numPages;
            //console.log(this.pdfDoc);
            this.renderPage(this.pageNum);
            
            });
        },
        queueRenderPage(num) {
            if (this.pageRendering) {
                this.pageNumPending = num;
            } else {
                this.renderPage(num);
            }
        },
        onPrevPage() {
            if (this.pageNum <= 1) {
                return;
            }
            this.pageNum--;
            this.queueRenderPage(this.pageNum);
        },   
        onNextPage() {
            if (this.pageNum >= this.pdfDoc.numPages) {
                return;
            }
            this.pageNum++;
            this.queueRenderPage(this.pageNum);
        }    
    },
    mounted(){   
        if(this.pdf_file){
           // this.loadPdf(this.getCdnUrl()+this.pdf_file.src);
           this.loadPdf();
        }        
    }
}
</script>
<style scoped>
canvas{
    width: 100%;
    height: 100%;    
}
.push-right{
    display: inline;
    float: right;
    position: relative;
    right: 0;
    line-height: 2.5em;
}
</style>
