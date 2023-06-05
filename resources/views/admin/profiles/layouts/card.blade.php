<div class="col-md-12">
    <div class="card card-widget widget-user">
        <div class="widget-user-header bg-danger">
            <h3 class="widget-user-username">
                Olá, {{ ucfirst(auth()->user()->name) }}
            </h3>
            <h5 class="widget-user-desc">Meus Processos</h5>
        </div>
        <div class="widget-user-image">
            <img src="{{ asset('assets/img/user.png') }}" alt="" class="rounded-full elevation-2 w-full h-full">
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">{{ $count_adm }}</h5>
                        <span class="description-text">Processos Administrativos</span>
                    </div>
                </div>
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">{{ $count_judicial }}</h5>
                        <span class="description-text">Processos Judiciais</span>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="description-block">
                        <h5 class="description-header">3,200</h5>
                        <span class="description-text">SALES</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
