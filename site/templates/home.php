<?php

$windows = $page->windows()->toStructure();

?>
<style>
  .chaos-window-1 {
    top: 30%;
    left: 30%;
    z-index: 1000;
  }

  .chaos-window-2 {
    top: 20%;
    left: 10%;
    z-index: 999;
  }

  .chaos-window-3 {
    top: 0%;
    left: 18%;
    z-index: 998;
  }

  .chaos-window-4 {
    top: 40%;
    right: 10%;
    z-index: 997;
  }

  .chaos-window-5 {
    top: 5%;
    right: 15%;
    z-index: 996;
  }

  .chaos-window-6 {
    top: 60%;
    left: 18%;
    z-index: 995;
  }

  .chaos-window-7 {
    top: 65%;
    right: 18%;
    z-index: 994;
  }

  .chaos-window-8 {
    top: 75%;
    left: 18%;
    z-index: 993;
  }

  .chaos-window-9 {
    top: 85%;
    left: 18%;
    z-index: 992;
  }

  .chaos-window-10 {
    top: 90%;
    left: 18%;
    z-index: 991;
  }
</style>

<?php snippet('header') ?>

<div x-data="{order: false, shareModal: false}" class="h-auto p-5" x-init="
      width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
      if (width < 1024) {
      order = true
      }" @resize.window="
      width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
      if (width < 1024) {
      order = true
      }">
  <image class="w-[480px] h-[480px] fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 -z-10" alt="Dithered image of the globe in green" src="/src/globe-dithered.png" width="480px" height="480px" />
  <?php snippet('chaos-order') ?>
  <!-- chaos -->
  <div x-cloak x-show="!order" x-transition.duration.450ms x-transition:enter.delay.500ms class="min-h-[calc(100vh-250px)] relative mt-16" :class="order ? 'opacity-0 ' : ''" id="window-container">
    <?php foreach ($windows as $index => $window) : ?>
      <article x-data="{ open : false }" @click="open = true" class="draggable absolute w-[450px] h-[275px] chaos-window-<?= $index + 1 ?>">
        <?php $content = $window->description();
        $page = $window->page()->toPage() ?>
        <?php snippet('window', ['title' => $window->title(), 'subheading' => $window->subheading()], slots: true) ?>
        <?php if ($content != "") : ?>
          <div class="p-4 overflow-auto">
            <?= $content->kt() ?>
          </div>
        <?php elseif ($page) : ?>
          <?php if ($image = $page->cover()->toFile()) : ?>
            <img class="w-full h-full object-cover" src="<?= $image->url() ?>" alt="<?= $image->alt()->esc() ?>">
          <?php endif ?>
        <?php endif ?>
        <?php endsnippet() ?>
        <?php snippet('modal', ['content' => $content, 'page' => $page, 'title' => $window->title(), 'subheading' => $window->subheading()]) ?>
      </article>
    <?php endforeach ?>
  </div>

  <!-- ordered -->
  <div x-cloak x-show="order" class="grid md:grid-cols-2 gap-4 md:gap-6 max-w-[924px] mx-auto mt-16" x-transition.duration.450ms x-transition:enter.delay.500ms>
    <?php foreach ($windows as $index => $window) : ?>
      <article x-data="{ open : false }" @click="open = true" class="<?php if ($index == 0) echo 'md:col-span-2' ?> h-[275px] cursor-pointer">
        <?php $content = $window->description();
        $page = $window->page()->toPage() ?>
        <?php snippet('window', ['title' => $window->title(), 'subheading' => $window->subheading()], slots: true) ?>
        <?php if ($content != "") : ?>
          <div class="p-4 overflow-auto">
            <?= $content->kt() ?>
          </div>
        <?php elseif ($page) : ?>
          <?php if ($image = $page->cover()->toFile()) : ?>
            <img class="w-full h-full object-cover" src="<?= $image->url() ?>" alt="<?= $image->alt()->esc() ?>">
          <?php endif ?>
        <?php endif ?>
        <?php endsnippet() ?>
        <?php snippet('modal', ['content' => $content, 'page' => $page, 'title' => $window->title(), 'subheading' => $window->subheading()]) ?>
      </article>
    <?php endforeach ?>
  </div>

</div>



<?php snippet('footer', ['title' => 'Hello!', 'subheading' => 'Subheading']) ?>


<script>
  Draggable.create(".draggable", {
    bounds: document.getElementById("window-container"),
  });
</script>