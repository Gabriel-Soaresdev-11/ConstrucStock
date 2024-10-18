<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ConstruckStock</title>

    <link rel="icon" type="image/png" href="{{asset('/imagens/logo_icons.png')}}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('../css/welcome.css') }}">
</head>

<body>

    <nav>
        <div class="logo">
            <img src="{{ asset('/imagens/logo_icons.png') }}" alt="Logo ConstrucStock">
            <p>ConstruckStock</p>
        </div>

        <div class="links">
            <ul>
                @if (Route::has('login'))
                    @auth
                        <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    @else
                        <li><a href="{{ url('login') }}">Log in</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ url('register') }}">Registrar</a></li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </nav>

    <section>
        <div class="inicio">
            <div class="text">
                <h1><span class="name">ConstrucStock</span> <br> Gestão de Estoque Simples e Eficaz <br>
                    <span class="subtitle">Controle seu estoque de materiais de construção e aumente a eficiência das
                        suas operações.</span>
                </h1>
                <a href="{{url("register")}}">Experimente Gratuitamente</a>
            </div>
        </div>
    </section>
    {{-- Descrição do produto --}}
    <section>
        <div class="produto">
            <div class="descricao">
                <h2>Uma Solução Completa para Gerenciar Seu Estoque</h2>
                <p>O ConstrucStock foi desenvolvido especialmente para o setor de materiais de construção. Ele oferece
                    controle total do seu estoque, relatórios detalhados de vendas, e uma interface intuitiva que
                    permite acompanhar o desempenho do seu negócio em tempo real.</p>
            </div>
            <div class="carrouseel">
                <div class="carrousel-container">
                    <div class="slide"><img src="{{ asset('/imagens/slide/1.jpg') }}" alt=""></div>

                    <div class="slide"><img src="{{ asset('/imagens/slide/2.jpg') }}" alt=""></div>

                    <div class="slide"><img src="{{ asset('/imagens/slide/3.jpg') }}" alt=""></div>

                    <div class="slide"><img src="{{ asset('/imagens/slide/4.jpg') }}" alt=""></div>

                    <div class="slide"><img src="{{ asset('/imagens/slide/5.jpg') }}" alt=""></div>

                    <div class="slide"><img src="{{ asset('/imagens/slide/1.jpg') }}" alt=""></div>
                </div>
            </div>
        </div>
    </section>

    <section class="porque-second">
        <div class="porque">
            <div class="porque-title">
                <h2>Por que Escolher o ConstrucStock?</h2>
            </div>
            <div class="lista">
                <ul>
                    <li>Controle Total do Estoque:
                        <p>Saiba exatamente o que você tem disponível em tempo real.</p>
                    </li>
                    <li>Relatórios Detalhados:
                        <p>Gere relatórios mensais de compras e vendas com apenas um clique.</p>
                    </li>
                    <li>Fácil de Usar:
                        <p> Uma plataforma intuitiva que economiza tempo e esforço.</p>
                    </li>
                    <li>Monitoramento de Vendas Fiadas:
                        <p>Controle eficiente de vendas a prazo e pagamentos pendentes.</p>
                    </li>
                    <li>Segurança:
                        <p>Seus dados são protegidos com autenticação e acesso personalizado.</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section>
        <div class="visual">
            <div class="texto">
                <h3>Veja como é fácil monitorar seu estoque e obter relatórios precisos com o ConstrucStock.</h3>
            </div>
            <div class="img">
                <img src="{{asset('/imagens/demostracao/1.png')}}" alt="">
                <img src="{{asset('/imagens/demostracao/2.png')}}" alt="">
            </div>

        </div>
    </section>

    <section>
        <div class="acao">
            <div class="info">
                <h3>Pronto para Simplificar Sua Gestão de Estoque?</h3>

                <p>Cadastre-se agora e comece a utilizar o ConstrucStock para organizar seu estoque e aumentar sua eficiência.</p>
            </div>
            <div class="botao">
                <a href="{{route('register')}}"">Cadastre-se Gratuitamente</a>
            </div>
        </div>
    </section>


    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <!-- Sobre a Empresa -->
                <div class="footer-section about">
                    <h3>Sobre Nós</h3>
                    <p>
                        A ConstrucStock é especializada em soluções para controle de estoque e vendas. Nossa missão é garantir eficiência e controle para pequenas e grandes empresas no setor de construção.
                    </p>
                </div>
    
                <!-- Links Úteis -->
                {{-- <div class="footer-section links">
                    <h3>Links Úteis</h3>
                    <ul>
                        <li><a href="#">Início</a></li>
                        <li><a href="#">Sobre</a></li>
                        <li><a href="#">Serviços</a></li>
                        <li><a href="#">Contato</a></li>
                    </ul>
                </div> --}}
    
                <!-- Contato -->
                <div class="footer-section contact">
                    <h3>Contato</h3>
                    <p class="contact-p">
                        (21) 983308167<br />
                        <a href="https://wa.me/5521983308167?text=Olá%20gostaria%20de%20mais%20informações
">WhatsApp ConstruckStock</a><br>
                        <a href="mailto:contato@construcstock.com">contato@construcstock.com</a>
                    </p>
                    <!-- Ícones de Redes Sociais -->
                    {{-- <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div> --}}
                </div>
            </div>
    
            <!-- Copyright -->
            <div class="footer-bottom">
                &copy; 2024 ConstrucStock. Todos os direitos reservados.
            </div>
        </div>
    </footer>
    


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.carrousel-container');
            const slides = document.querySelectorAll('.carrousel-container .slide');
            let currentSlide = 0;
            const totalSlides = slides.length;

            // Função para alternar os slides verticalmente
            function changeSlide() {
                currentSlide++;

                // Se chegar na última (cópia da primeira), faz a transição suave e depois volta instantaneamente para o início
                if (currentSlide === totalSlides - 1) {
                    container.style.transition = 'transform 2s ease-in-out';
                    container.style.transform = `translateY(${-currentSlide * 594}px)`;

                    // Após a transição, volta ao primeiro slide (sem transição)
                    setTimeout(() => {
                        container.style.transition = 'none';
                        currentSlide = 0;
                        container.style.transform = `translateY(0)`;
                    }, 2000); // Tempo igual à duração da transição (2 segundos)
                } else {
                    // Movimentação normal entre slides
                    container.style.transition = 'transform 2s ease-in-out';
                    container.style.transform = `translateY(${-currentSlide * 594}px)`;
                }
            }

            // Definir intervalo para mudar de slide a cada 7 segundos (para combinar com a transição suave)
            setInterval(changeSlide, 7000); // Mudar a cada 7 segundos
        });
    </script>


    <!-- Slick CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- Slick Theme CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
</body>

</html>
