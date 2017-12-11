@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Bine ați venit</div>

                    <div class="panel-body">
                        @if (Auth::guest())
                            <span style="text-align: center;">
                                <h4>Regulament privind organizarea şi desfăşurarea</h4>

                                <h4>CONCURSULUI DE INFORMATICĂ</h4>
                                <h4>CALCULATORUL JOC ȘI JOACĂ</h4>

                                <h4>An şcolar 2017-2018</h4>
                            </span>
                            <p style="text-align: justify">
                            <h5 style="font-weight: bold">Argument</h5>
                            </p>
                            <p>Orice societate informatizată are nevoie de tot mai mulţi specialişti în domeniul
                                informaticii şi al tehnologiei informaţiei.
                            </p>
                            <p>Pentru educaţia din România pregătirea de performanţă a elevilor în domeniul informaticii
                                este o necesitate imperioasă. Această pregătire trebuie dublată de stimularea spiritului
                                competitiv, a activității creatoare a elevilor, de promovarea elevilor cu aptitudini
                                deosebite în domeniul tehnico-aplicativ.
                            </p>
                            <p>Deoarece utilizarea calculatorului este vitală în societatea de azi, iar mulți copiii își
                                petrec timpul în fața calculatorului, ar trebui ca aceștia să fie îndrumați spre
                                 activități ce reprezintă un stimulent educativ pentru ei.
                            </p>

                            <p style="text-align: justify">
                            <h5 style="font-weight: bold">Prezentare generală</h5>
                            </p>
                            <p>Concursul de informatică <span
                                        style="font-weight: bold">“Calculatorul joc și joacă”</span> este o competiție
                                şcolară care se desfăşoară în conformitate cu prevederile Metodologiei-cadru de
                                organizare şi desfăşurare a competiţiilor şcolare, aprobată cu O.M. Nr. 3035/10.01.2012.
                            </p>

                            <p style="text-align: justify">
                            <h5 style="font-weight: bold">1. Obiectivele Concursului</h5>
                            </p>
                            <p>Concursul îşi propune:
                            <ul>
                                <li>cultivarea și promovarea spiritului de competiție în domeniul tehnico-aplicativ;
                                </li>
                                <li>exersarea deprinderilor de a utiliza eficient calculatorul și diverse soft-uri;</li>
                                <li>creșterea interesului pentru crearea de aplicații informatice;</li>
                                <li>dezvoltarea competenţelor de programare ale elevilor prin crearea unei gândiri
                                    algoritmice şi prin utilizarea eficientă a tehnicii de calcul şi a mijloacelor
                                    moderne
                                    de comunicare;
                                </li>
                                <li>realizarea unor orientări școlare și profesionale a copiilor, în strânsă corelare cu
                                    cerințele actuale și de perspectivă ale economiei de piață.
                                </li>
                            </ul>
                            </p>

                            <p style="text-align: justify">
                            <h5 style="font-weight: bold">2. Organizarea Concursului</h5>
                            </p>
                            <p>Concursul se desfășoară pe platformă online și se organizează pe următoarele secţiuni:
                            <ol>
                                <li>Gimnaziu structurat în două probe obligatorii: T.I.C. și Programare;</li>
                                <li>Liceu–filiera teoretică și vocațională structurat în două probe obligatorii: T.I.C.
                                    și Realizarea unei prezentări/pagini web pe o temă dată;
                                </li>
                                <li>Învățământ profesional și tehnic structurat în două probe obligatorii: T.I.C. și
                                    Realizarea unei prezentări/pagini web pe o temă dată.
                                </li>
                            </ol>
                            </p>

                            <p style="text-align: justify">
                            <h5 style="font-weight: bold">3. Înscrierea</h5>
                            </p>
                            <p>Înscrierea se realizează o singură dată pe platformă în perioada menționată în calendar. Ulterior datei limită de înscriere nu se vor accepta nici un fel de modificări la lista cu participanţi. Absența la una dintre probe atrage după sine descalificarea concurentului.
                            </p>
                            <p>
                                În urma înscrierii, fiecare participant va primi un user și o parolă cu care se va loga pe platformă în zilele de concurs în intervalul orar 10.00-13.00.
                            </p>

                            <p style="text-align: justify">
                            <h5 style="font-weight: bold">4. Desfășurarea concursului</h5>
                            </p>
                            <p>La toate secțiunile prima probă constă într-un test grilă și realizarea unui desen pe o temă precizată în ziua concursului.
                            </p>
                            <p>
                                Proba a doua la secțiunea <span style="font-weight: bold">Gimnaziu</span> constă în rezolvarea a trei probleme de natură algoritmică folosind aplicația Scratch.
                            </p>
                            <p>
                                La secțiunile <span style="font-weight: bold">Liceu–filiera teoretică și vocațională</span> și <span style="font-weight: bold">Învățământ profesional și tehnic</span> proba a doua constă în realizarea unei Prezentări multimedia/Pagini web pe tema <span style="font-weight: bold">De la copilărie la adolescență-meseria visată</span>.
                            </p>
                            <p>Probele se vor desfășura conform calendarului anexă la prezentul regulament.
                            </p>

                            <p style="text-align: justify">
                            <h5 style="font-weight: bold">5. Evaluarea</h5>
                            </p>
                            <p>Fiecare probă  va fi evaluată cu câte 100 de puncte. La proba de T.I.C. testul grilă este format din 16 itemi evaluați cu câte 5 puncte.  Pentru evaluarea desenului se vor avea în vedere următoarele criterii:
                                <table style="border: 0px">
                                <tr><td>Creativitate și simț artistic</td><td>- 5 puncte;</td></tr>
                                <tr><td>Elemente de design și cromatică</td><td>- 5 puncte;</td></tr>
                                <tr><td>Mesaj</td><td>- 5 puncte;</td></tr>
                                <tr><td>Încadrarea în temă</td><td>- 5 puncte.</td></tr>
                            </table>
                            </p>
                            <p>
                                La cea de a doua probă de la secțiunea Gimnaziu, fiecare problemă va fi evaluată cu câte 30 de puncte, acordându-se 10 puncte din oficiu. La celelalte două secțiuni evaluarea se va face în funcție de următoarele criterii:
                                <table>
                                <tr><td>Creativitate și simț artistic</td><td>-20 puncte;</td></tr>
                                <tr><td>Elemente de design și cromatică</td><td>-20 puncte;</td></tr>
                                <tr><td>Mesaj</td><td>-20 puncte;</td></tr>
                                <tr><td>Încadrarea în temă</td><td>-20 puncte;</td></tr>
                                <tr><td>Complexitate</td><td>- 20 puncte.</td></tr>
                            </table>
                            </p>
                            <p>
                                La finalul concursului punctajele obținute la cele două probe de către fiecare participant se vor aduna, iar rezultatul va reprezenta punctajul final al concurentului.
                            </p>

                            <p style="text-align: justify">
                            <h5 style="font-weight: bold">6. Premierea</h5>
                            </p>
                            <p>Premierea se realizează pe fiecare secțiune în ordinea descrescătoare a punctajelor finale obținute de participanți.
                            </p>

                            <p style="text-align: justify">
                            <h5 style="font-weight: bold">7. Programa</h5>
                            </p>
                            <p>Programa pentru testul grilă include Elemente de arhitectură a unui sistem de calcul, Tipuri de dispozitive: de intrare, de ieșire, de intrare-ieșire, de stocare a datelor, Sisteme de operare și Internet.
                            </p>

                            <p style="text-align: justify">
                            <h5 style="font-weight: bold">8. Dispoziții finale</h5>
                            </p>
                            <p>Pe site-ul concursului, pentru fiecare secţiune, vor fi afişate: clasamentul și lista premianţilor.
                            </p>




                        @else

                            Sunteți autentificat ca {{ Auth::user()->name }}!

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
