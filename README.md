<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://i.ibb.co/0Z9vyg4/2020-05-21-02-14-17.png">
    </a>
    <h1 align="center">Новостной сайт на Yii2</h1>
    <br>
</p>
<p>Новостной сайт с регистрацией и оповещением пользователей о событиях. Сайт содержит: 
<ul>
    <li>страницы регистрации и аутентификации</li>
    <li>просмотр списка и отдельной новости доступный для всех</li>
    <li>возможность добавлять, редактировать и удалять новости</li>
    <li>оповещать пользователя по email:
        <ul>
            <li>при регистрации и изменении пароля</li>
            <li>при добавлении или удалении новости другим пользователем</li>
        </ul>
    </li>
    <li>возможность выборочно отключать уведомления, например: пользователь хочет получать оповещение только при изменении пароля или при добавлении новости</li>
    <li>возможность немедленной отправки уведомлений выбранным пользователям</li>
    <li>возможность легкого добавления новых способов оповещения, например telegram или push</li>
</ul>


DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      components/         Компоненты приложения
      config/             contains application configurations
      controllers/        contains Web controller classes
      database/
      docker/
      helper/
      mail/               contains view files for e-mails
      migration/
      models/             contains model classes
      rbac/
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources
      widgets/   
