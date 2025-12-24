<footer>
    <div class="container-fluid main_footer p-0">
        <div class="row footer_row">
            <div class="col-md-4">
                <p class="h4">ABOUT COMPANY</p>
                <p class="footer_des">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugiat adipisci
                    pariatur omnis deserunt culpa nobis tenetur ducimus iste laborum nam!</p>
                <div class="icon_wrapper">
                    <i class="fa-brands fa-google-plus"></i>
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-square-twitter"></i>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <p class="h4">SEARCH SOMETHING</p>
                <div>
                    <div class="form-group">
                        <input type="text"
                            class="form-control search_footer" name="search_footer" id="search_footer" aria-describedby="helpId" placeholder="What are you looking for?">
                    </div>
                </div>
                <ul class="footer_list">
                    <li class="list-group-item "><i class="fa-solid fa-location-dot"></i> R. de Dona Estefânia 84 - A, 1000-158 Lisboa</li>
                    <li class="list-group-item "><i class="fa-solid fa-envelope"></i>+351 565 484 595 </li>
                    <li class="list-group-item"> <i class="fa-solid fa-phone"></i><a class="mailto" href="mailto:webminds@mail.com">webminds@mail.com</a></li>
                </ul>

            </div>
            <div class="col-md-4">
                <p class="h4">SCHEDULE</p>
                <div class="table-responsive">
                    <table class="table footer_table table-dark">
                        <tr>
                            <td>Mon-Thu</td>
                            <td>8:00 - 19:00</td>
                        </tr>
                        <tr class="">
                            <td>Fri-Sat</td>
                            <td>8:00 - 17:00</td>
                        </tr>
                        <tr class="">
                            <td>Sundat</td>
                            <td>Closed</td>
                        </tr>

                    </table>
                </div>
            </div>


        </div>
        <div class="container-fluid right">
            <p>
                © 2025 Copyright: Jose Muñoz
            </p>
        </div>

    </div>
</footer>

<script>
    (g => {
        var h, a, k, p = "The Google Maps JavaScript API",
            c = "google",
            l = "importLibrary",
            q = "__ib__",
            m = document,
            b = window;
        b = b[c] || (b[c] = {});
        var d = b.maps || (b.maps = {}),
            r = new Set,
            e = new URLSearchParams,
            u = () => h || (h = new Promise(async (f, n) => {
                await (a = m.createElement("script"));
                e.set("libraries", [...r] + "");
                for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                e.set("callback", c + ".maps." + q);
                a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                d[q] = f;
                a.onerror = () => h = n(Error(p + " could not load."));
                a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                m.head.append(a)
            }));
        d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
    })({
        key: "AIzaSyDcY0-9qcZ_qD9XXs4K8rKhO1ih-EP1S2g",
        v: "weekly",
    });
</script>
<script src="public/js/validateInputs.js"></script>
<script src="public/js/jQuery.js"></script>
<script src="public/js/ajaxFuntion.js"></script>
<script src="public/js/main.js"></script>


</body>

</html>