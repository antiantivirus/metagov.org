<div class="container max-w-3xl pb-16">
  <div class="mb-8">
    <div class="flex gap-4 items-start">
      <h1><?= $page->title()->esc() ?></h1>
      <?php foreach ($page->projectStatus()->split() as $key => $status) : ?>
        <?php if ($key == 0) : ?>
          <span class="tag active"><?= $status ?></span>
        <?php else : ?>
          <span class="tag secondary active"><?= $status ?></span>
        <?php endif ?>
      <?php endforeach ?>
      <?php if ($page->seekingParticipants()->toBool()) : ?>
        <span class="tag secondary active">✅ SEEKING PARTICIPANTS</span>
      <?php endif ?>
    </div>
    <h3>
      <?= $page->subHeading()->esc() ?>
    </h3>
  </div>

  <?php if ($page->cover()->isNotEmpty()) : ?>
    <img class="mb-8" src="<?= $page->image()->url() ?>" alt="<?= $page->image()->alt()->esc() ?>">
  <?php endif ?>

  <article>

  <!-- Project meta -->
  <div class="mb-8 grid grid-cols-3 justify-evenly gap-6">
    <div>
      <?php if ($page->links()->isNotEmpty()) : ?>
        <h5 class="mb-2">LINKS</h5>
        <div>
          <?php
          $links = $page->links()->toStructure();
          foreach ($links as $link) : ?>
            <a class="inline-block mr-2" href="<?= $link->content()->url() ?>" target="_blank">
              <?= $link->content()->text() ?>
            </a>
          <?php endforeach ?>
        </div>
      <?php endif ?>
    </div>
    <div class="space-y-1">
      <?php if ($page->type()->isNotEmpty()) : ?>
        <h5 class="mb-2">PROJECT TYPE</h5>
        <?php foreach ($page->type()->split() as $type) : ?>
          <span class="tag"><?= $type ?></span>
        <?php endforeach ?>
      <?php endif ?>
    </div>
    <div>
      <?php if ($page->contact()->isNotEmpty()) : ?>
        <div class="mb-4">
          <h5 class="mb-2">PRINCIPLE CONTACT</h5>
          <?= Html::email($page->contact()) ?>
        </div>
      <?php endif ?>
      <?php if ($page->members()->isNotEmpty()) : ?>
        <div>
          <h5 class="mb-2">MEMBERS</h5>
          <?php
          $members =  $page->members()->toPages();
          foreach ($members as $member) : ?>
            <p><?= $member->title() ?></p>
          <?php endforeach ?>
        </div>
      <?php endif ?>
      
    </div>
  </div>

  <!-- Project body -->
  <?php if ($page->description()->isNotEmpty()) : ?>
    <div class="mb-8">
      <h5>DESCRIPTION</h5>
      <div class="prose">
        <?= $page->description()->kt() ?>
      </div>
    </div>
  <?php endif ?>

  <?php if ($page->participate()->isNotEmpty()) : ?>
    <div class="mb-8">
      <h5>PATHS TO PARTICIPATION + DISCUSSION FORUM</h5>
      <div class="prose">
        <?= $page->participate()->kt() ?>
      </div>
    </div>
  <?php endif ?>

  <?php if ($page->meetings()->isNotEmpty()) : ?>
    <div>
      <h5>MEETINGS</h5>
      <div class="prose">
        <?= $page->meetings()->kt() ?>
      </div>
    </div>
  <?php endif ?>

  </article>
</div>