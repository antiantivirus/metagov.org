<?php snippet('header') ?>
<div class="container">
  <div class="mb-8">
    <h1><?= $page->title()->esc() ?></h1>
    <h2 class="text-large font-serif font-normal">
      <?= $page->subHeading()->esc() ?>
    </h2>
  </div>

  <div class="mb-8 prose">
    <?php foreach ($page->content()->content()->toBlocks() as $block) : ?>
      <div id="<?= $block->id() ?>" class="block block-type-<?= $block->type() ?>">
        <?php snippet('blocks/' . $block->type(), [
          'block' => $block,
          'theme' => 'dark'
        ]) ?>
      </div>
    <?php endforeach ?>
  </div>

  <section>
    <div class="mb-8 flex justify-between items-center">
      <h3>Community directory</h3>
      <div class="mb-12 flex flex-col lg:flex-row lg:items-center gap-2 lg:gap-4">
        <span>FILTERS:</span>
        <?php snippet('blocks/filter', ['filters' => $roles, 'group' => 'Role', 'label' => 'Role']) ?>
      </div>
    </div>

    <ul class="grid sm:grid-cols-4 xl:grid-cols-6 gap-4 sm:gap-6 mx-auto list">
      <?php foreach ($page->children()->listed() as $person) : ?>
        <li class="cursor-pointer" x-data="{ open : false }" @click="open = true" data-title="<?= $person->title() ?>" data-role="<?= $person->role() ?? null ?>">
          <?php if ($image = $person->image()) : ?>
            <img class="w-full border border-brand/30 rounded mb-4" src="<?= $image->crop(154, 120, "center")->url() ?>" srcset="<?= $image->srcset(
                                                                                                                                    [
                                                                                                                                      '1x'  => ['width' => 154, 'height' => 120, 'crop' => 'center'],
                                                                                                                                      '2x'  => ['width' => 308, 'height' => 240, 'crop' => 'center'],
                                                                                                                                      '3x'  => ['width' => 462, 'height' => 360, 'crop' => 'center'],
                                                                                                                                    ]
                                                                                                                                  ) ?>" alt="<?= $image->alt()->esc() ?>" width="<?= $image->resize(154)->width() ?>" height="<?= $image->resize(235)->height() ?>">
          <?php endif ?>
          <p class="text-secondary"><?= $person->title() ?></p>
          <p><?= $person->affiliation() ?></p>
          <div>
            <a href="<?= $person->website() ?>" target="_blank">🌐 www</a>
            <a href="mailto:<?= $person->email() ?>" target="_blank" class="ml-4">📧 email</a>
          </div>
          <?php snippet('modal', ['page' => $person, 'title' => $person->title(), 'subheading' => '']) ?>
        </li>
      <?php endforeach ?>
    </ul>
  </section>
</div>
<?php snippet('footer') ?>

<script>
  let filters = {
    Role: [],
  }

  var options = {
    valueNames: [{
      data: ['title', 'role', ]
    }]
  }

  var peopleList = new List('people', options);

  const updateList = () => {
    peopleList.filter(function(item) {
      let role = false

      if (filters.Role.indexOf(item.values().category) > -1 || filters.Role.length == 0) {
        role = true
      } else {
        role = false
      }

      if (role) return true
      else return false
    })
  }

  const toggleFilter = (e) => {
    const checked = e.target.checked
    const value = e.target.dataset.value
    const group = e.target.dataset.group

    if (checked) {
      filters[group].push(value)
    } else {
      const index = filters[group].indexOf(value);
      if (index > -1) {
        filters[group].splice(index, 1);
      }
    }

    console.log(filters)

    updateList()
  }
</script>