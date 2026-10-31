@php
    $email = config('company.contact.email');
    $contactLine = $email ? "me email në {$email}" : 'nëpërmjet formularit të kontaktit në këtë faqe interneti';
@endphp

<h2 id="controller">1. Kush jemi</h2>
<p>Kjo faqe interneti administrohet nga <strong>{{ config('company.name') }}</strong> (NUIS {{ config('company.nuis') }}), shoqëri aksionare e regjistruar në Shqipëri me seli të regjistruar në {{ implode(', ', config('company.locations.tirana.lines')) }}. Ne jemi përgjegjës për të dhënat personale që përpunohen nëpërmjet kësaj faqeje interneti.</p>

<h2 id="data">2. Të dhënat që mbledhim</h2>
<p>Mbledhim vetëm të dhënat e nevojshme për funksionimin e kësaj faqeje dhe për t’ju përgjigjur:</p>
<ul>
    <li><strong>Formularët e kontaktit dhe të kërkesave:</strong> emri, emri i kompanisë, adresa e email-it, numri i telefonit, shteti, lloji i kërkesës, kërkesat për produkte, sasitë e vlerësuara dhe përmbajtja e mesazhit tuaj.</li>
    <li><strong>Aplikimet për punë:</strong> informacionet që zgjidhni të ndani për përvojën dhe disponueshmërinë tuaj, si dhe çdo CV që na dërgoni me kërkesën tonë.</li>
    <li><strong>Të dhëna teknike:</strong> regjistrime standarde të serverit, si adresa IP, lloji i shfletuesit dhe faqet e kërkuara, të përdorura për siguri dhe për mbarëvajtjen e faqes.</li>
    <li><strong>Cookies:</strong> cookies thelbësore të përshkruara në <a href="{{ lroute('legal.cookies') }}">Politikën e Cookies</a>.</li>
</ul>

<h2 id="use">3. Si i përdorim të dhënat</h2>
<ul>
    <li>Për t’iu përgjigjur kërkesës suaj dhe, kur është e përshtatshme, për të diskutuar një marrëdhënie tregtare.</li>
    <li>Për të vlerësuar aplikimet për punë.</li>
    <li>Për të mbrojtur faqen nga keqpërdorimi, përfshirë mesazhet e padëshiruara dhe abuzimin me formularët.</li>
    <li>Për të përmbushur detyrimet ligjore.</li>
</ul>
<p>Ne nuk i shesim të dhënat personale dhe nuk i përdorim ato për vendimmarrje të automatizuar.</p>

<h2 id="legal-basis">4. Baza ligjore</h2>
<p>Ne i përpunojmë të dhënat personale në bazë të pëlqimit tuaj (të dhënë kur dërgoni një formular), të hapave të ndërmarrë me kërkesën tuaj përpara lidhjes së një kontrate, të interesave tona të ligjshme për funksionimin dhe sigurinë e kësaj faqeje dhe për t’iu përgjigjur korrespondencës tregtare, si dhe të përmbushjes së detyrimeve ligjore.</p>

<h2 id="sharing">5. Ndarja e të dhënave</h2>
<p>Të dhënat personale aksesohen vetëm nga personeli që ka nevojë për to për të trajtuar kërkesën tuaj. Mund t’i ndajmë ato me ofrues shërbimesh që strehojnë këtë faqe ose dërgojnë email në emrin tonë, me detyrime të përshtatshme konfidencialiteti, ose kur kërkohet me ligj.</p>

<h2 id="retention">6. Ruajtja</h2>
<p>Ne i ruajmë të dhënat e kërkesave për aq kohë sa është e nevojshme për t’ju përgjigjur dhe për të menaxhuar çdo marrëdhënie tregtare që rezulton, dhe më pas i fshijmë, përveç rasteve kur ligji kërkon një periudhë më të gjatë. Aplikimet e pasuksesshme për punë ruhen vetëm për aq kohë sa nevojitet për mundësi të ardhshme, përveç nëse kërkoni t’i fshijmë më herët.</p>

<h2 id="security">7. Siguria</h2>
<p>Ne përdorim masa teknike dhe organizative të përshtatshme për të mbrojtur të dhënat personale, përfshirë lidhje të enkriptuara, mbrojtje nga abuzimi i automatizuar i formularëve dhe akses të kufizuar në informacionin e dërguar.</p>

<h2 id="rights">8. Të drejtat tuaja</h2>
<p>Në përputhje me ligjin në fuqi, ju mund të kërkoni akses, korrigjim ose fshirje të të dhënave tuaja personale, të kundërshtoni ose të kufizoni përpunimin e tyre dhe të tërhiqni pëlqimin në çdo kohë. Gjithashtu mund të paraqisni ankesë pranë Komisionerit për të Drejtën e Informimit dhe Mbrojtjen e të Dhënave Personale. Për të ushtruar të drejtat tuaja, na kontaktoni {{ $contactLine }} ose na shkruani në adresën tonë të regjistruar.</p>

<h2 id="changes">9. Ndryshimet në këtë politikë</h2>
<p>Ne mund ta përditësojmë këtë politikë herë pas here. Data në krye të kësaj faqeje tregon kur është rishikuar për herë të fundit.</p>
