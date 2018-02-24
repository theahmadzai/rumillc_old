<?php require 'templates/top.php';?>
<?php require 'templates/slider.php';?>
<section class="section">
    <div class="section__heading"><i class="fa fa-info" aria-hidden="true"></i>Know us</div>
    <div id="accordion" class="section__content accordion">
        <h3>Introduction</h3>
        <div>
            <p>Rumi Trading LLC (Limited Liability Company) is registered with ACBR (Afghanistan Central Business Registry) of the ministry of commerce &amp; industries of Afghanistan operate as Afghanistan’s leading export management company (EMC) since 2017.</p>
        </div>

        <h3>What is an EMC?</h3>
        <div>
            <p><blockquote>All manufacturers without export experience should consider an EMC. Even sophisticated exporters may want to consider using an EMC for selected products for certain markets. Firms looking for new markets in order to accelerate their business growth should consider using an EMC.</blockquote>
            Nelson, T. Joyner, Former Chairman, the Federation of International Trade Association
            An EMC is a firm that provides an exclusive outsourced export department for established market-leading manufacturers. We earn the exclusive right to represent our manufacturer’s brands in new markets. Think of us as you would an exclusive regional distributor in your home market.</p>
        </div>

        <h3>Why use Rumi?</h3>
        <div>
            <p>Instant Access to foreign Markets – we’ve already built a sales and distribution network in our markets. It takes years to find dependable and trustworthy buyers. We’ve negotiated payment terms and credit lines. We have relationships with freight forwarders and transportation companies. We can plug you in right away.<br>
            Save time, effort &amp; Money – we’ve already spent the time researching and testing foreign market import requirements and processes. We understand nuances of marketing and promoting products in our markets. Last &amp; most important, we have a firm understanding of the unique wholesale and retail market in each of our target markets.<br>
            Free market research – we travel to our markets consistently, perform surveys, discuss market conditions regularly with our distributors, and receive import data from various local sources.<br>
            Risk avoidance – we take title to the product as soon as it is loaded on our trucks at your distribution point in Afghanistan. All risks involving payment, currency exchange, customs requirements, transportation, quality control and volatile market conditions is assumed by us.<br>
            Limited resources – Do you have the time, money and experience to successfully export with your current resources? Can you afford to make mistakes?</p>
        </div>

        <h3>What are our requirements in a partner?</h3>
        <div>
            <p>Desire – we are looking to partner with manufacturers that have the desire to export their products. Ideally, our partner will not have invested much time and money in educating themselves about the details of exporting and nuances of selling in foreign markets – that’s what we are here for!<br>
            Quality – Due to our exclusivity, we become invested in your brand and our reputation is tied to your product. We will only represent high quality products that are market leaders in Afghanistan.<br>
            Afghan Label – Due to the fact that Afghan products are not well labeled and that most of the Afghan products are better recognized as Afghan, Afghan label is the recognition we would like to have.<br>
            Marketing Support – A common mistake of exporters is the assumption that the products will sell itself based in its status in home country. Our partners must be prepared to appropriately support a product launch in a new market.<br>
            Long-term vision – Penetrating a new market that is already dominated by vast distribution takes a lot of time. Patience in a new market will yield very profitable long-term results.<br>
            <br>
            What products are we selling in international markets?<br>
            Although Rumi’s vision is to be Afghanistan’s leading export management company and target every high quality product in Afghanistan and take it to international markets but the company has prioritized Afghan dried fruit, nuts &amp; saffron however this does not mean that other products are automatically eliminated from the list. Because Rumi understands that these products are Afghanistan’s priority for export &amp; thus is tough job to do, the company has committed itself to take on this heavy responsibility.<br>
            <br>
            Which International Markets are we targeting?<br>
            Rumi has initially targeted Central Asia, South Asia, Turkey, a number of EU countries, UAE, Belarus &amp; Russia but this target could expand and change as Rumi deploys teams for on-ground market assessments to these and other emerging markets.<br>
            <br>
            <blockquote>Join us in sharing high quality products with the world.</blockquote>
            </p>
        </div>
    </div>

    <div class="section__heading"><i class="fa fa-address-card" aria-hidden="true"></i>Address</div>
    <div class="section__content">
        Rumi Trading LLC,<br>
        Between Kolola Pushta &amp; Old Taimani Squares,<br>
        House number 236, Kabul-AFG<br><br>
        www.rumillc.com<br>
        info@rumillc.com<br>
        <b>+93 (0) 784516129</b>
    </div>

    <div class="section__heading"><i class="fa fa-map-marker" aria-hidden="true"></i>Location</div>
    <div id="map" style="margin-top:2rem; width:100%; height: 500px;"></div>
</section>
<script>
$(document).ready(function(){
    $( "#accordion" ).accordion({
        heightStyle: "content"
    });
});
var settings = {
    position: {
        lat: 34.544838,
        lng: 69.152089
    },
    title: 'Rumi Trading LLC',
    content: "<b>Address</b><br>Rumi Trading LLC,<br>Between Kolola Pushta & Old Taimani Squares,<br>House number 236, Kabul-AFG"
};

function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: settings.position,
        zoom: 16,
        minZoom: 16,
        draggable: false
    });

    var marker = new google.maps.Marker({
        position: settings.position,
        map: map,
        title: settings.title
    });

    var infowindow = new google.maps.InfoWindow({
        content: settings.content
    });

    marker.addListener('click', function () {
        infowindow.open(map, marker);
    });
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCdkOSJS85NODOMhu9OVmSF-_H2Y-K0Kg&callback=initMap" async defer></script>
<?php require 'templates/bot.php';?>
