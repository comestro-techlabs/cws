
<div class="bg-primary  overflow-x-hidden">
    <div class="relative flex py-12 flex-col md:flex-row bg-slate-100 h-auto md:h-[400px] my-0 py-7 md:py-2 items-center px-5 md:px-[10%] overflow-hidden ">
        <!-- Background Image and Gradient Overlay -->
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('assets/banner.png') }}');"></div>
            <!-- Main Modal -->
          
        </div>
    </div>
 </div>
<script>
function toggleModal() {
    const modal = document.getElementById('authentication-modal');
    modal.classList.toggle('hidden');
}

function closeSuccessModal() {
    const modal = document.getElementById('success-modal');
    modal.classList.add('hidden');
}
</script>
