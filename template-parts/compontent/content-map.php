<?php
/**
* The template used for displaying page content
*
* @package normcore
* @since NormCore 2.0
*/
?>

<section id="tour">
    <div id="map-container">
        <div id="map"></div>
        <div id="tour-list-container">
            <div id="map-controls">
                <div class="toggle normal">
                    <div class="text">21 & Over Only</div>
                    <input id="over21" type="checkbox">
                    <label class="toggle-item" for="over21"></label>
                </div>
                <div class="toggle normal">
                    <div class="text">All Ages</div>
                    <input id="allages" type="checkbox">
                    <label class="toggle-item" for="allages"></label>
                </div>
                <div class="toggle normal">
                    <div class="text">Hide Private Events</div>
                    <input id="private" type="checkbox">
                    <label class="toggle-item" for="private"></label>
                </div>
            </div>
            <ul id="tour-list"></ul>
        </div>
    </div>

</section>
