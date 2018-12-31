<!--<div class="content-box">
    <div class="big-error-w">
        <h1>Restricted</h1>
        <h5>Authorization Failed</h5>
        <h4>You are not authorized to view this page.</h4>
        <form>
            <div class="input-group">
                <input class="form-control" placeholder="Enter your search query here" type="text">
                <div class="input-group-btn">
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>-->
<div class="md:flex min-h-screen">
    <div class="w-full md:w-1/2 bg-white flex items-center justify-center">
        <div class="max-w-sm m-8">
            <div class="text-black text-5xl md:text-15xl font-black">401</div>
            <div class="w-16 h-1 bg-purple-light my-3 md:my-6"></div>
            <p class="text-grey-darker text-2xl md:text-3xl font-light mb-8 leading-normal">
              Unauthorized: Access is denied due to invalid credentials.
            </p>
            <a href="<?php echo base_url();?>">
                <button class="bg-transparent text-grey-darkest font-bold uppercase tracking-wide py-3 px-6 border-2 border-grey-light hover:border-grey rounded-lg">GO HOME
                </button>
            </a>
        </div>
    </div>

    <div class="relative pb-full md:flex md:pb-0 md:min-h-screen w-full md:w-1/2">
        <div class="page-content500 absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
        </div>
    </div>
</div>