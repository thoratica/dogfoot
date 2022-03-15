<?php

function getTextBetweenTags($string, $tagname)
{
  $pattern = "/<$tagname ?(.*)>(.*)<\/$tagname>/";
  preg_match($pattern, $string, $matches);
  return $matches;
}

class DogFootTemplate extends BaseTemplate
{

  public function execute()
  {
    $this->data['content_actions']['nstab-main']['text'] = wfMessage('view')->parse();
    $this->html('headelement');
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <div class="df-screen">
      <nav class="df-nav">
        <div class="df-nav-inner">
          <a href="<?php
                    echo htmlspecialchars($this->data['nav_urls']['mainpage']['href']);
                    ?>" class="df-logo-anchor">
            <img src="<?php $this->text('logopath'); ?>" />
          </a>
          <div class="df-nav-menu">
            <?php
            if ($this->getSkin()->getUser()->isRegistered()) {
            ?>
              <div class="df-button-wrapper">
                <a title="파일 업로드" class="df-upload-button">
                  <i class="fas fa-cloud-upload-alt text-neutral-600"></i>
                </a>
                <div class="df-logon-menu">
                  <button class="df-logon-menu-button">
                    <i class="fa-solid fa-user"></i>
                  </button>
                  <div class="df-logon-menu-popup">
                    <div class="df-logon-menu-popup-inner">
                      <?php foreach ($this->getPersonalTools() as $key => $item) {
                      ?>
                        <a id="<?php echo $item['id'] ?>" href="<?php echo $item['links'][0]['href'] ?>" title="<?php echo $item['links'][0]['text'] ?>" class="df-logon-menu-popup-item"><?php echo $item['links'][0]['text'] ?></a>
                      <?php
                      } ?>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            } else { ?>
              <a id="<?php echo $this->getPersonalTools()['login']['id'] ?>" href="<?php echo $this->getPersonalTools()['login']['links'][0]['href'] ?>" title="<?php echo $this->getPersonalTools()['login']['links'][0]['text'] ?>" class="df-login-button">
                <i class="fa-solid fa-right-from-bracket"></i>
              </a>
            <?php
            }
            ?>
          </div>
        </div>
      </nav>

      <div class="flex">
        <section class="mx-auto px-3 xs:px-6 flex max-w-7xl w-full">
          <article class="py-6 w-full">
            <div class="flex flex-col border-0 mb-2.5">
              <div class="flex items-center">
                <h1 class="text-gray-900 outline-none focus:filter focus:brightness-95 transition-all font-semibold text-3xl xs:text-4xl m-0 p-0 border-0">
                  <?php $this->html('title'); ?>
                </h1>
                <div class="ml-auto flex gap-x-1.5">
                  <?php
                  if ($this->getSkin()->getUser()->isRegistered()) {
                  ?>
                    <a id="ca-edit" href="<?php echo $this->data['content_actions']['ve-edit']['href'] ?? '#' ?>" class="bg-gray-100 hover:bg-gray-200 outline-none transition-colors duration-300 ease-in-out rounded-xl px-[11px] py-2" title="시각 편집 모드">
                      <i class="fa-solid fa-eye text-gray-500"></i>
                    </a>
                    <a href="<?php echo $this->data['content_actions']['edit']['href'] ?? '#' ?>" class="bg-gray-100 hover:bg-gray-200 outline-none transition-colors duration-300 ease-in-out rounded-xl px-3 py-2" title="원본 편집 모드">
                      <i class="fa-solid fa-pen text-gray-500"></i>
                    </a>

                    <div class="profile group">
                      <button class="bg-gray-100 hover:bg-gray-200 outline-none transition-colors duration-300 ease-in-out rounded-xl px-[15px] py-2" title="더보기">
                        <i class="fa-solid fa-caret-down text-gray-500"></i>
                      </button>
                      <div class="fixed h-0">
                        <div class="flex relative bg-gray-50 p-1.5 border border-gray-50 shadow-lg rounded-lg right-[calc(100%_-_42px)] opacity-0 invisible transform -translate-y-4 transition-all duration-300 ease-in-out group-hover:opacity-100 group-hover:visible group-hover:translate-x-1 group-hover:translate-y-0 group-focus-within:opacity-100 group-focus-within:visible group-focus-within:translate-x-1 group-focus-within:translate-y-0">
                          <a href="<?php echo $this->data['content_actions']['history']['href'] ?? '#' ?>" class="text-gray-900 hover:bg-gray-100 outline-none transition-colors duration-300 ease-in-out rounded-xl px-3 py-2" title="역사">
                            <i class="fa-solid fa-clock-rotate-left text-gray-500"></i>
                          </a>
                          <a href="<?php echo $this->data['content_actions']['move']['href'] ?? '#' ?>" class="hover:bg-gray-100 outline-none transition-colors duration-300 ease-in-out rounded-xl px-3 py-2" title="이동">
                            <i class="fa-solid fa-angles-right text-gray-500"></i>
                          </a>
                          <a href="<?php echo $this->data['content_actions']['delete']['href'] ?? '#' ?>" class="hover:bg-gray-100 outline-none transition-colors duration-300 ease-in-out rounded-xl px-3 py-2" title="삭제">
                            <i class="fa-solid fa-trash text-gray-500"></i>
                          </a>
                          <a href="<?php echo $this->data['content_actions']['protect']['href'] ?? '#' ?>" class="hover:bg-gray-100 outline-none transition-colors duration-300 ease-in-out rounded-xl px-3 py-2" title="보호">
                            <i class="fa-solid fa-lock text-gray-500"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  <?php
                  } else { ?>
                    <a href="<?php echo $this->data['content_actions']['history']['href'] ?? '#' ?>" class="bg-gray-100 hover:bg-gray-200 outline-none transition-colors duration-300 ease-in-out rounded-xl px-3 py-2" title="역사">
                      <i class="fa-solid fa-clock-rotate-left text-gray-500"></i>
                    </a>
                  <?php
                  }
                  ?>
                </div>
              </div>
              <?php $this->html('catlinks'); ?>
            </div>
            <section id="content">
              <div id="mw-content-text">
                <?php $this->html('bodytext'); ?>
              </div>
            </section>
          </article>
        </section>
      </div>
    </div>

    </html>
<?php
  }
}
