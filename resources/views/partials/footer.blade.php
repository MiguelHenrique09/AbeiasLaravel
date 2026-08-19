<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">

            <div class="col-lg-3 col-md-6">
                <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Nossas Políticas</h4>
                <a class="btn btn-link" >Políticas de Privacidade</a>
                <a class="btn btn-link" >Termos e Condições</a>
            </div>

            <div class="col-lg-3 col-md-6">
                <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Fale Conosco</h4>
                <p class="mb-2">
                    <i class="fa fa-map-marker-alt me-3"></i>
                    {{ config('app.endereco', 'Rua dos Programadores 123, Formiga, MG') }}
                </p>
                <p class="mb-2">
                    <i class="fa fa-phone-alt me-3"></i>
                    {{ config('app.telefone', '(37) 91234-5678') }}
                </p>
                <p class="mb-2">
                    <i class="fa fa-envelope me-3"></i>
                    {{ config('app.email_contato', 'abeiasburguer@gmail.com') }}
                </p>
                <div class="d-flex pt-2 gap-2">
                    {{-- Redes sociais (preencha os links em config/app.php) --}}
                    @if(config('app.instagram'))
                        <a class="btn btn-outline-light btn-social" href=target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif
                    @if(config('app.facebook'))
                        <a class="btn btn-outline-light btn-social" href=target="_blank">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif
                    @if(config('app.whatsapp'))
                        <a class="btn btn-outline-light btn-social"
                           href= target="_blank">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    @endif
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Horário</h4>
                <p class="mb-1"><i class="fa fa-clock me-3"></i>Segunda – Sexta</p>
                <p class="mb-3 ps-4">18h00 – 23h00</p>
                <p class="mb-1"><i class="fa fa-clock me-3"></i>Sábado – Domingo</p>
                <p class="mb-0 ps-4">17h00 – 00h00</p>
            </div>

          

        </div>
    </div>

    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; {{ date('Y') }} <a class="border-bottom" href="{{ route('home') }}">Abeias Burguer</a>.
                    Todos os direitos reservados.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <small class="text-muted">Versão {{ config('app.version', '1.0.0') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
