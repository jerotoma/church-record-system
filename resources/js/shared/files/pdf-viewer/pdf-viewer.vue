<template>
  <section>
    <div class="row">
        <div class="col-md-12">
            <div class="pdf-main-container">
                <canvas :id="'pdf-render-' + pdf_file.id"></canvas>
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
            pageIsRendering:false,
            pageNumIsPending:null,
            media:this.pdf_file,
           
        };
    },
    components: {
       
    },
    methods:{
        getCdnUrl(){
          return vimmak.cdnUrl;
       },
       renderPage(num, pdfMedia){
            const canvas = document.querySelector("#pdf-render-"+pdfMedia.id);
            const context = canvas.getContext('2d');
            if(this.pdfDoc){
                this.pageIsRendering = true;
                this.pdfDoc.getPage(num).then(page =>{
                    var viewport = page.getViewport(this.scale);
                    //console.log(viewport);
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    page.render(renderContext);                   
                }, (reason) => {
                // PDF loading error
                console.error(reason);
                }); 
           }
       },
       loadPdf(pdfMedia){
        var loadingTask = pdfjsLib.getDocument('http://localhost:8080/pdf/F000703770_PA.pdf');
        //var loadingTask = pdfjsLib.getDocument(this.getCdnUrl() + pdfMedia.src);
        loadingTask.promise.then(_pdfDoc => {
            this.pdfDoc = _pdfDoc;
            this.renderPage(this.pageNum, pdfMedia);               
        });
       }
    },
    mounted(){   
        if(this.pdf_file){
           // this.loadPdf(this.getCdnUrl()+this.pdf_file.src);
           this.loadPdf(this.pdf_file);
        }        
    }
}
</script>
<style scoped>
canvas{
    width: 100%;
    height: 100%;    
}
</style>
