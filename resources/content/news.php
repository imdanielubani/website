<?php

/*
|--------------------------------------------------------------------------
| News & Insights content
|--------------------------------------------------------------------------
|
| Each entry is one article. Fields:
|
|   title, slug, excerpt, content (Markdown), featured_image (image library
|   key, see config/images.php), category, author, published_at,
|   is_published, seo_title, seo_description, is_sample
|
| Translations: add an array keyed by language code (e.g. 'sq') holding
| title, excerpt, content, seo_title and seo_description in that language.
| Missing fields fall back to the English values.
|
| SAMPLE CONTENT: the articles below are general industry explainers written
| as placeholders to demonstrate the layout. They are flagged with
| 'is_sample' => true, which displays a notice on the site. Replace or
| remove them, and set 'is_sample' => false, before public launch.
|
| Articles only appear when 'is_published' is true and 'published_at' is in
| the past, so drafts and scheduled posts can be kept here safely.
|
*/

return [

    [
        'title' => 'Understanding the petroleum products supply chain',
        'slug' => 'understanding-the-petroleum-products-supply-chain',
        'sq' => [
            'title' => 'Të kuptosh zinxhirin e furnizimit me produkte nafte',
            'excerpt' => 'Nga terminali i importit te klienti me shumicë: një përmbledhje e thjeshtë se si lëvizin karburantet e rafinuara në një zinxhir furnizimi rajonal dhe ku fitohet ose humbet besueshmëria.',
            'seo_title' => 'Zinxhiri i furnizimit me produkte nafte',
            'seo_description' => 'Një përmbledhje se si produktet e rafinuara të naftës lëvizin nga terminalet e importit te klientët me shumicë dhe çfarë e bën furnizimin të besueshëm.',
            'content' => <<<'MD'
Çdo litër karburant që arrin te një klient tregtar ka kaluar nëpër një varg dorëzimesh: anije, terminale, depozitim, kontrolle cilësie, transport rrugor dhe faturim. Çdo hallkë shton kosto dhe rrezik. Kuptimi i këtij zinxhiri i ndihmon blerësit të bëjnë pyetjet e duhura te furnitorët e tyre.

## Importi dhe pritja

Për shumë tregje në rajonin e Adriatikut, produktet e rafinuara mbërrijnë me det. Ngarkesat shkarkohen në një terminal hidrokarburesh, merren mostra dhe maten, dhe më pas zhdoganohen përpara se të mund të lëvizin në brendësi të vendit. Koha ka rëndësi: disponueshmëria e kalatës, moti dhe dokumentacioni ndikojnë se kur produkti bëhet i disponueshëm.

## Depozitimi dhe cilësia

Pasi pranohen, produktet mbahen në depozita të dedikuara. Praktika e mirë i ndan llojet, regjistron çdo lëvizje dhe e lidh dokumentacionin e cilësisë me çdo ngarkesë, në mënyrë që klienti ta gjurmojë atë që merr deri te burimi.

## Shpërndarja me shumicë

Klientët me shumicë zakonisht e marrin produktin me autobot ose kërkojnë dorëzim. Kushtet tregtare, përfshirë bazën e çmimit, sasitë, afatet e dorëzimit dhe pagesën, bien dakord paraprakisht dhe përcaktohen në një kontratë furnizimi.

## Nga vjen besueshmëria

- **Planifikimi:** përputhja e ngarkesave që mbërrijnë me kërkesën e pritshme.
- **Dokumentacioni:** dokumente të sakta cilësie dhe doganore në çdo dorëzim.
- **Komunikimi:** njoftim i hershëm për klientët kur ndryshojnë oraret.
- **Siguria:** procedura të disiplinuara në çdo pikë ku lëviz produkti.

*Ky artikull është një shpjegim i përgjithshëm dhe nuk përshkruan operacione specifike të AL.GLOBAL OIL.*
MD,
        ],
        'excerpt' => 'From import terminal to wholesale customer: a plain-language overview of how refined fuels move through a regional supply chain, and where reliability is won or lost.',
        'featured_image' => 'tanker-red',
        'category' => 'Insights',
        'author' => 'AL.GLOBAL OIL Editorial',
        'published_at' => '2026-09-18 09:00:00',
        'is_published' => true,
        'seo_title' => 'Understanding the Petroleum Products Supply Chain',
        'seo_description' => 'An overview of how refined petroleum products move from import terminals to wholesale customers, and what drives reliable supply.',
        'is_sample' => true,
        'content' => <<<'MD'
Every litre of fuel that reaches a commercial customer has passed through a chain of handovers: vessels, terminals, storage, quality checks, road transport and invoicing. Each link adds cost and risk. Understanding the chain helps buyers ask the right questions of their suppliers.

## Import and reception

For many markets in the Adriatic region, refined products arrive by sea. Cargoes are discharged at a hydrocarbons terminal, sampled and measured, then cleared through customs before they can move inland. Timing matters: berth availability, weather and documentation all shape when product becomes available.

## Storage and quality

Once received, products are held in dedicated storage. Good practice separates grades, tracks every movement and keeps quality documentation linked to each batch, so a customer can trace what they receive back to its source.

## Wholesale distribution

Wholesale customers typically collect product by road tanker or arrange delivery. The commercial terms, including pricing basis, volumes, delivery windows and payment, are agreed in advance and set out in a supply contract.

## Where reliability comes from

- **Planning:** matching incoming cargoes with expected demand.
- **Documentation:** accurate quality and customs paperwork at every handover.
- **Communication:** early notice to customers when schedules change.
- **Safety:** disciplined procedures at every point where product is moved.

*This article is a general explainer and does not describe specific AL.GLOBAL OIL operations.*
MD,
    ],

    [
        'title' => 'What commercial fuel buyers should ask a wholesale supplier',
        'slug' => 'what-commercial-fuel-buyers-should-ask-a-wholesale-supplier',
        'sq' => [
            'title' => 'Çfarë duhet të pyesin blerësit tregtarë një furnitor karburanti me shumicë',
            'excerpt' => 'Licencimi, dokumentacioni i produktit, kushtet e dorëzimit dhe komunikimi: një listë praktike për bizneset që vlerësojnë një furnitor me shumicë të produkteve të naftës.',
            'seo_title' => 'Pyetje për një furnitor karburanti me shumicë',
            'seo_description' => 'Një listë kontrolli praktike për blerësit tregtarë që vlerësojnë një furnitor me shumicë të produkteve të naftës.',
            'content' => <<<'MD'
Zgjedhja e një furnitori karburanti me shumicë është vendim për vazhdimësinë. Oferta më e lirë rrallë është e gjithë historia. Këto janë pyetjet që bëjnë zakonisht blerësit me përvojë.

## A është furnitori i licencuar siç duhet?

Tregtimi me shumicë i produkteve të naftës është veprimtari e rregulluar. Pyesni cilat licenca dhe leje ka furnitori dhe nëse ato janë në fuqi.

## Çfarë dokumentacioni shoqëron çdo dorëzim?

Prisni specifikime të produktit, certifikata cilësie dhe fletëdorëzime që identifikojnë qartë llojin dhe sasinë e furnizuar.

## Si bien dakord çmimet dhe sasitë?

Kuptoni bazën e çmimit, sa shpesh përditësohet, sasitë minimale dhe maksimale, dhe çfarë ndodh nëse ju nevojitet më shumë ose më pak se sa është planifikuar.

## Si do të komunikoni?

Një person i caktuar kontakti, rrugë të qarta përshkallëzimi dhe njoftim i hershëm për çdo ndryshim orari janë shenja të një furnitori që vlerëson marrëdhëniet afatgjata.

## Si menaxhohet siguria?

Pyesni si e menaxhon furnitori sigurinë gjatë ngarkimit, transportit dhe dorëzimit, dhe si raportohen incidentet.

*Ky artikull është një udhëzues i përgjithshëm dhe nuk përbën këshillë tregtare ose ligjore.*
MD,
        ],
        'excerpt' => 'Licensing, product documentation, delivery terms and communication: a practical checklist for businesses evaluating a wholesale petroleum supplier.',
        'featured_image' => 'truck-station',
        'category' => 'Insights',
        'author' => 'AL.GLOBAL OIL Editorial',
        'published_at' => '2026-08-04 09:00:00',
        'is_published' => true,
        'seo_title' => 'Questions to Ask a Wholesale Fuel Supplier',
        'seo_description' => 'A practical checklist for commercial buyers evaluating a wholesale petroleum products supplier.',
        'is_sample' => true,
        'content' => <<<'MD'
Choosing a wholesale fuel supplier is a decision about continuity. The cheapest quote is rarely the whole story. These are the questions experienced buyers tend to ask.

## Is the supplier properly licensed?

Wholesale trading in petroleum products is a regulated activity. Ask which licences and permits the supplier holds and whether they are current.

## What documentation comes with each delivery?

Expect product specifications, quality certificates and delivery notes that clearly identify the grade and quantity supplied.

## How are prices and volumes agreed?

Understand the pricing basis, how often it is updated, minimum and maximum volumes, and what happens if you need more or less than planned.

## How will you communicate?

A named contact, clear escalation routes and early notice of any schedule changes are signs of a supplier that values long-term relationships.

## How is safety managed?

Ask how the supplier manages safety during loading, transport and delivery, and how incidents are reported.

*This article is a general guide and does not constitute commercial or legal advice.*
MD,
    ],

    [
        'title' => 'Health, safety and the environment in fuel logistics',
        'slug' => 'health-safety-and-the-environment-in-fuel-logistics',
        'sq' => [
            'title' => 'Shëndeti, siguria dhe mjedisi në logjistikën e karburanteve',
            'excerpt' => 'Pse disiplina SHSM është themeli i çdo operacioni me naftë, dhe praktikat e përditshme që mbrojnë njerëzit, komunitetet dhe mjedisin.',
            'seo_title' => 'Shëndeti, siguria dhe mjedisi në logjistikën e karburanteve',
            'seo_description' => 'Praktikat e përditshme që mbështesin një logjistikë të sigurt dhe të përgjegjshme mjedisore të produkteve të naftës.',
            'content' => <<<'MD'
Në sektorin e naftës, performanca në shëndet, siguri dhe mjedis nuk është një departament më vete. Është pjesë e mënyrës si planifikohet dhe kryhet çdo detyrë.

## Planifikimi para fillimit të punës

Operacionet e sigurta fillojnë me kuptimin e rreziqeve të çdo detyre, nga transferimi i produktit ndërmjet rezervuarëve deri te ngarkimi i një autoboti, dhe me rënien dakord për masat e kontrollit përpara se të fillojë puna.

## Njerëz kompetentë

Trajnimi, përgjegjësitë e qarta dhe autoriteti për të ndalur punën kur diçka duket gabim janë thelbësore. Një kulturë ku njerëzit flasin hapur parandalon incidentet.

## Mbrojtja e mjedisit

Izolimi, parandalimi i rrjedhjeve, trajtimi i duhur i mbetjeve dhe gatishmëria për të reaguar ndaj derdhjeve mbrojnë tokën, ujin dhe komunitetet fqinje.

## Të mësosh dhe të përmirësohesh

Rastet e afërta me incident dhe vëzhgimet kanë vlerë. Regjistrimi i tyre, hetimi i shkaqeve dhe ndarja e mësimeve e kthejnë përvojën e përditshme në përmirësim të vazhdueshëm.

*Ky artikull është një përmbledhje e përgjithshme dhe nuk përshkruan procedura ose performancë specifike të shoqërisë.*
MD,
        ],
        'excerpt' => 'Why HSE discipline is the foundation of every petroleum operation, and the everyday practices that keep people, communities and the environment protected.',
        'featured_image' => 'engineer-hardhat',
        'category' => 'HSE',
        'author' => 'AL.GLOBAL OIL Editorial',
        'published_at' => '2026-06-12 09:00:00',
        'is_published' => true,
        'seo_title' => 'Health, Safety and Environment in Fuel Logistics',
        'seo_description' => 'The everyday practices that underpin safe, environmentally responsible petroleum logistics.',
        'is_sample' => true,
        'content' => <<<'MD'
In the petroleum sector, health, safety and environmental performance is not a separate department. It is part of how every task is planned and carried out.

## Planning before work begins

Safe operations start with understanding the hazards of each task, from transferring product between tanks to loading a road tanker, and agreeing the controls before work starts.

## Competent people

Training, clear responsibilities and the authority to stop work when something looks wrong are essential. A culture where people speak up prevents incidents.

## Protecting the environment

Containment, leak prevention, proper handling of waste and readiness to respond to spills protect soil, water and neighbouring communities.

## Learning and improving

Near misses and observations are valuable. Recording them, investigating causes and sharing lessons turns everyday experience into continuous improvement.

*This article is a general overview and does not describe specific company procedures or performance.*
MD,
    ],

    [
        'title' => 'Albania’s position in Adriatic energy trade',
        'slug' => 'albanias-position-in-adriatic-energy-trade',
        'sq' => [
            'title' => 'Pozicioni i Shqipërisë në tregtinë e energjisë në Adriatik',
            'excerpt' => 'Me një vijë të gjatë bregdetare në Adriatik dhe infrastrukturë portuale të konsoliduar, Shqipëria ndodhet në rrugë natyrore për lëvizjen e produkteve energjetike në Evropën Juglindore.',
            'seo_title' => 'Shqipëria dhe tregtia e energjisë në Adriatik',
            'seo_description' => 'Si ndikojnë bregdeti adriatik i Shqipërisë dhe infrastruktura portuale në lëvizjen e produkteve energjetike në rajon.',
            'content' => <<<'MD'
Gjeografia formëson tregtinë e energjisë. Bregdeti adriatik i Shqipërisë e vendos atë pranë rrugëve detare të Mesdheut dhe tregjeve fqinje të Ballkanit.

## Portet si porta hyrëse

Zonat bregdetare rreth Durrësit, përfshirë Porto Romanon, kanë infrastrukturë për pritjen dhe trajtimin e hidrokarbureve. Porte si këto shërbejnë si pika ku ngarkesat detare takohen me shpërndarjen në brendësi.

## Lidhja me rajonin

Nga bregdeti, produktet mund të lëvizin me rrugë drejt klientëve në të gjithë vendin dhe rajonin më gjerë. Procedurat efikase doganore dhe depozitimi i besueshëm janë thelbësore për lëvizjen e vazhdueshme të produktit.

## Vështrim përpara

Ndërsa kërkesa rajonale zhvillohet, infrastruktura e mirëmenaxhuar, përputhshmëria e fortë rregullatore dhe partneritetet tregtare të besueshme do të vazhdojnë të kenë rëndësi.

*Ky artikull është një përmbledhje e përgjithshme e industrisë. Ai nuk bën pretendime për objekte, kapacitete ose pozicione tregu specifike.*
MD,
        ],
        'excerpt' => 'With a long Adriatic coastline and established port infrastructure, Albania sits on natural routes for the movement of energy products in South-East Europe.',
        'featured_image' => 'port-tanks',
        'category' => 'Industry',
        'author' => 'AL.GLOBAL OIL Editorial',
        'published_at' => '2026-04-22 09:00:00',
        'is_published' => true,
        'seo_title' => 'Albania and Adriatic Energy Trade',
        'seo_description' => 'How Albania’s Adriatic coastline and port infrastructure shape the movement of energy products in the region.',
        'is_sample' => true,
        'content' => <<<'MD'
Geography shapes energy trade. Albania’s Adriatic coastline places it within reach of Mediterranean shipping routes and neighbouring Balkan markets.

## Ports as gateways

Coastal areas around Durrës, including Porto Romano, host infrastructure for receiving and handling hydrocarbons. Ports like these act as gateways where seaborne cargoes meet inland distribution.

## Connecting to the region

From the coast, products can move by road to customers across the country and the wider region. Efficient customs procedures and reliable storage are key to keeping product flowing.

## Looking ahead

As regional demand evolves, well-run infrastructure, strong regulatory compliance and dependable commercial partnerships will continue to matter.

*This article is a general industry overview. It does not make claims about specific facilities, capacities or market positions.*
MD,
    ],

    [
        'title' => 'How to start a business inquiry with AL.GLOBAL OIL',
        'slug' => 'how-to-start-a-business-inquiry',
        'sq' => [
            'title' => 'Si të filloni një kërkesë biznesi me AL.GLOBAL OIL',
            'excerpt' => 'Qoftë klient i mundshëm, furnitor apo partner, ja çfarë të përfshini në mesazhin tuaj të parë që ekipi ynë të përgjigjet me efikasitet.',
            'seo_title' => 'Si të filloni një kërkesë biznesi',
            'seo_description' => 'Çfarë të përfshini në një kërkesë biznesi drejtuar AL.GLOBAL OIL SH.A që ekipi ynë të përgjigjet me efikasitet.',
            'content' => <<<'MD'
Mesazhet e para të qarta sjellin përgjigje më të shpejta dhe më të dobishme. Kur na kontaktoni nëpërmjet [formularit të kërkesës së biznesit](/sq/business-inquiry), është e dobishme të përfshini sa më poshtë.

## Për organizatën tuaj

Emrin e kompanisë, shtetin dhe personin me të cilin duhet të flasim.

## Çfarë ju nevojitet

Produktet ose shërbimet që ju interesojnë, sasitë orientuese dhe afatin me të cilin punoni. Vlerësimet janë të mjaftueshme.

## Propozime nga furnitorë dhe partnerë

Nëse na ofroni produkte ose shërbime, përshkruani çfarë furnizoni, ku operoni dhe çdo dokumentacion përkatës që mund të ndani më vonë.

## Çfarë ndodh më pas

Ekipi ynë shqyrton çdo kërkesë dhe përgjigjet nëpërmjet të dhënave të kontaktit që na jepni. Ju lutemi mos përfshini dokumente tregtare konfidenciale në mesazhin e parë.
MD,
        ],
        'excerpt' => 'Whether you are a potential customer, supplier or partner, here is what to include in your first message so our team can respond efficiently.',
        'featured_image' => 'meeting-room',
        'category' => 'Company',
        'author' => 'AL.GLOBAL OIL',
        'published_at' => '2026-02-10 09:00:00',
        'is_published' => true,
        'seo_title' => 'How to Start a Business Inquiry',
        'seo_description' => 'What to include in a business inquiry to AL.GLOBAL OIL SH.A so our team can respond efficiently.',
        'is_sample' => true,
        'content' => <<<'MD'
Clear first messages lead to faster, more useful replies. When contacting us through the [business inquiry form](/business-inquiry), it helps to include the following.

## About your organisation

Your company name, country, and the person we should speak with.

## What you need

The products or services you are interested in, indicative quantities, and the timeframe you are working to. Estimates are fine.

## Supplier and partner proposals

If you are offering products or services to us, describe what you supply, where you operate, and any relevant documentation you can share later.

## What happens next

Our team reviews each inquiry and responds through the contact details you provide. Please do not include confidential commercial documents in your first message.
MD,
    ],

    [
        'title' => 'Draft: example of an unpublished article',
        'slug' => 'draft-example',
        'excerpt' => 'Drafts stay hidden until is_published is true and the publish date has passed.',
        'featured_image' => 'tanks-sky',
        'category' => 'Company',
        'author' => 'AL.GLOBAL OIL',
        'published_at' => null,
        'is_published' => false,
        'is_sample' => true,
        'content' => 'This draft demonstrates that unpublished articles are not shown on the website.',
    ],

];
