<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Купи каско</title>
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="stylesheet" href="build.css">
  <link rel="stylesheet" href="sprite.css">

  <script src="bundle.js"></script>

  <script src="http://localhost:35729/livereload.js"></script>
  <script src="http://localhost:8080/webpack-dev-server.js"></script>

  <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>

  <style>
    body {
      font: 13px/20px "Roboto", Arial, sans-serif;;
    }
  </style>
</head>
<body>

<div class="it-step-nav" it-step-nav>
  <div class="container">
    <div class="it-step-nav__required">
      <div class="it-step-nav__list">
        <div class="it-step-nav__item">

          <div class="it-step" it-for-step="car_mark">
            <div class="it-step__relative">

              <div class="it-step__arrow"></div>
              <button class="it-step__button">1</button>
              <a class="it-step__link" href="#">Выберите марку и модель своего автомобиля</a>
            </div>

          </div>
        </div>

        <div class="it-step-nav__item">
          <div class="it-step" it-for-step="drivers+credit">
            <div class="it-step__relative">

              <div class="it-step__arrow"></div>
              <button class="it-step__button">2</button>
              <a class="it-step__link" href="#">Укажите возраст и стаж водителей</a>
            </div>
          </div>
        </div>

        <div class="it-step-nav__item">

          <div class="it-step it-step--highlighted" it-for-step="program_selection">
            <div class="it-step__relative">

              <div class="it-step__arrow"></div>
              <button class="it-step__button">3</button>
              <a class="it-step__link" href="#">Лучшая цена</a>
            </div>
          </div>
        </div>

        <div class="it-step-nav__item">

          <div class="it-step" it-for-step="extra_parameters">
            <div class="it-step__relative">
              <div class="it-step__arrow"></div>
              <button class="it-step__button">4</button>
              <a class="it-step__link" href="#"><span class="it-break">Дополнительные</span> услуги и опции</a>
            </div>
          </div>
        </div>

        <div class="it-step-nav__item">

          <div class="it-step" it-for-step="order">
            <div class="it-step__relative">
              <div class="it-step__arrow"></div>
              <button class="it-step__button">5</button>
              <a class="it-step__link" href="#">Оформление заказа</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div it-step="car_mark" class="it-box it-box--padding">
  <table it-car-mark class="it-select">
    <tbody>
    </tbody>
    <tfoot>
    <tr>
      <td colspan="4"></td>
      <td><a href="#" class="it-show">Показать все</a></td>
    </tr>
    </tfoot>
  </table>
</div>


<div it-step="car_manufacturing_year" class="it-box it-box--padding">
  <table it-car-manufacturing-year class="it-select">
    <tbody></tbody>
  </table>
</div>


<div it-step="car_model_group" class="it-box it-box--padding">
  <table it-car-model-group class="it-select">
    <tbody>
    </tbody>
  </table>
</div>

<div it-step="car_model+car_cost" class="it-box it-box--padding">
  <table it-car-model class="it-select it-select-break">
    <tbody>
    </tbody>
  </table>

  <div it-car-cost>
    <input type="text">
    <div class="slider_wrapper">
      <div class="slider"></div>
      <div class="range">
        <span>от <span class="min"></span></span>
        <span>до <span class="max"></span></span>
      </div>
    </div>
  </div>

  <div class="it-forward_wrapper clearfix">
    <button class="btn btn-success pull-right" it-forward>Далее</button>
  </div>
</div>

<div it-step="drivers+credit" class="it-box it-box--padding it-box--gray">
  <div class="row">
    <div class="col-sm-3">
      <div class="it-car-details">
        <h4><span it-show="show.car_mark"></span> <span it-show="show.car_model"></span></h4>
        <p><span it-show-format="calc.car_cost"></span> р.</p>
        <p><span it-show="internal.yearFilter"></span> г.</p>
      </div>
    </div>
    <div class="col-sm-9 it-box--right-side">
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
            <label>Кол-во водителей</label>
            <select class="form-control" it-driver-select>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="multi">Мультидрайв</option>
            </select>
          </div>
        </div>
        <div class="col-md-8 col-sm-8">
          <div class="row" it-driver-multi>
            <div class="col-md-3 col-sm-4">
              <div class="form-group">
                <label>Мин. возраст</label>
                <input class="form-control" maxlength="2" type="text" it-driver-minimal-age="">
              </div>
            </div>
            <div class="col-md-3 col-sm-4">
              <div class="form-group">
                <label>Мин. стаж</label>
                <input class="form-control" maxlength="2" type="text" it-driver-minimal-experience="">
              </div>
            </div>
          </div>
          <div it-driver-count>
            <div class="row">
              <div class="col-md-4 col-sm-3">
                <div class="form-group">
                  <label>Возраст</label>
                  <input class="form-control" it-driver-age>
                </div>
              </div>
              <div class="col-md-4 col-sm-3">
                <div class="form-group">
                  <label>Стаж</label>
                  <input it-driver-experience class="form-control">
                </div>
              </div>
              <div class="col-md-4 col-sm-3">
                <div class="form-group">
                  <label>Пол</label>
                  <select it-driver-gender class="form-control">
                    <option value="M">М</option>
                    <option value="F">Ж</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <div class="form-group">
            <label>Куплен в кредит</label>
            <select class="form-control" it-credit>
              <option>Нет</option>
            </select>
          </div>
        </div>
        <div class="col-md-8 col-sm-4">
          <div class="form-group">
            <label>Рассрочка</label>
            <select class="form-control" it-installments>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-5">
          <div class="form-group">
            <label>Противоугонная система:</label>
            <select class="form-control" it-antitheft>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group warranty">
            <label style="margin-bottom: 0"><input type="checkbox" it-car-on-warranty/> Автомобиль находится на гарантии</label>
          </div>
          <!--<div style="margin-top: -20px;">-->
          <!--<button class="btn" it-forward>Далее</button>-->
          <!--</div>-->
        </div>
        <div class="col-sm-6">
          <button class="btn btn-success pull-right" it-forward>Далее</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div it-step="program_selection" class="it-program-selection">
  <div it-calculation it-program></div>
  <div class="it-box">
    <div class="it-program-showcase it-program-showcase--move3rd">

      <div class="it-program-showcase__progress">
        <div class="progress" it-program-progress>
          <div class="progress-bar">
            Опрошено компаний: 0 из 11
          </div>
        </div>
      </div>

      <div class="it-program-showcase__list" it-answer-place>
        <div class="it-program-showcase__item" it-answer-0>
          <div class="it-program it-program--highlighted">
            <div class="it-program__title">
              <div><img it-logo></div>
            </div>

            <div class="it-program__details">
              <div class="it-program__price  it-program__price--highlighted"><span it-price></span>р.</div>

              <div class="it-program__options" it-option></div>

              <div class="it-program__accept">
                <button type="button" class="button button__blue it-btn-forward--active" it-accept>Заказать</button>
              </div>
            </div>
          </div>
        </div>
        <div class="it-program-showcase__item" it-answer-1>
          <div class="it-program">
            <div class="it-program__title">
              <div><img it-logo></div>
            </div>

            <div class="it-program__details">
              <div class="it-program__price"><span it-price></span>р.</div>

              <div class="it-program__options" it-option>
              </div>
              <div class="it-program__accept">
                <button type="button" class="button button__default" it-accept>Заказать</button>
              </div>
            </div>
          </div>
        </div>
        <div class="it-program-showcase__item" it-answer-2>
          <div class="it-program">
            <div class="it-program__title">
              <div><img it-logo></div>
            </div>

            <div class="it-program__details">
              <div class="it-program__price"><span it-price></span>р.</div>

              <div class="it-program__options" it-option>
              </div>
              <div class="it-program__accept">
                <button type="button" class="button button__default" it-accept>Заказать</button>
              </div>
            </div>
          </div>
        </div>
        <div class="it-program-showcase__item" it-answer-3>
          <div class="it-program">
            <div class="it-program__title">
              <div><img it-logo></div>
            </div>

            <div class="it-program__details">
              <div class="it-program__price"><span it-price></span>р.</div>

              <div class="it-program__options" it-option>
              </div>
              <div class="it-program__accept">
                <button type="button" class="button button__default" it-accept>Заказать</button>
              </div>
            </div>
          </div>
        </div>
        <div class="it-program-showcase__item" it-answer-4>
          <div class="it-program">
            <div class="it-program__title">
              <div><img it-logo></div>
            </div>

            <div class="it-program__details">
              <div class="it-program__price"><span it-price></span>р.</div>

              <div class="it-program__options" it-option>
              </div>
              <div class="it-program__accept">
                <button type="button" class="button button__default" it-accept>Заказать</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--<div class="it-divider"></div>-->

  <div class="it-calculation">
    <div class="it-calculation__highlight">
      Расчет <span class="it-calculation__number">№
            <span it-show="calculation.id"></span>
          </span>
    </div>

    <div class="it-calculation__note"> Для быстрого
      заказа или консультации сообщите № расчета нашим специалистам
    </div>
  </div>


  <div it-answer-template class="it-remain-programs">

    <div class="it-remain-programs__template">

      <div class="it-remain-programs__cell one">
        <div class="it-remain-programs__title"><img it-logo></div>
      </div>

      <div class="it-remain-programs__cell two">
        <div class="it-remain-programs__price"><span it-price></span>р.</div>
      </div>

      <div class="it-remain-programs__cell three">
        <div class="it-remain-programs__options" it-option>
        </div>
      </div>

      <div class="it-remain-programs__cell four">
        <div class="it-remain-programs__accept">
          <button type="button" class="button button__default pull-right" it-accept>Заказать</button>
        </div>
      </div>

    </div><!-- /.__template -->

  </div><!-- /.it-remain-programs -->

  <div class="it-program-messages it-program-messages--independent" it-selected-program="">
    <div class="it-program-messages__messages it-program-messages--errors" it-errors=""></div>
    <div class="it-program-messages__messages it-program-messages--warnings" it-warnings="">
      <div>Обязательно укажите мощность двигателя ТС для корректного расчета. Расчет произведен с условием Мощность двигателя 100 л.с.</div>
    </div>
    <div class="it-program-messages__messages it-program-messages--messages" it-messages=""></div>
    <div class="it-program-messages__messages" it-print-msg=""></div>
    <div class="it-program-messages__options" it-options=""></div>
  </div>

</div>


<div it-step="extra_parameters">

  <div class="it-box it-box--padding">
    <div class="it-result-summary">
      <div class="it-result-summary__container">
        <div class="it-result-summary__details">
          <div><strong>Проверьте введенные данные:</strong></div>
          <div><span it-show="show.car_mark"></span> <span it-show="show.car_model"></span></div>
          <div><span it-show-format="calculation.car_cost"></span> р., <span
              it-show="calculation.car_manufacturing_year"></span> г.
          </div>
          <div it-show-drivers>
            <div>Возраст: <span it-age></span>,
              стаж: <span it-experience></span>,
              <span it-gender></span>
            </div>
          </div>
        </div>
        <div class="it-result-summary__credit">
          <div it-show-credit></div>
          <div it-show-warranty></div>
        </div>
      </div>
      <div class="it-result-summary__product">
        <p>Выбранный страховой продукт:</p>
        <h4 it-show="program.program.title"></h4>
      </div>
    </div>

    <hr class="it-box__splitter">

    <div class="it-program-messages" it-program-messages>
      <div class="it-program-messages__messages it-program-messages--errors" it-errors>

      </div>
      <div class="it-program-messages__messages it-program-messages--warnings" it-warnings>

      </div>
      <div class="it-program-messages__messages it-program-messages--messages" it-messages>

      </div>
      <div class="it-program-messages__messages" it-print-msg>

      </div>
    </div>

    <div class="it-program-details">
      <div class="it-options" it-option-container>
        <div it-title class="it-options__title">
        </div>
        <div it-note class="it-options__note">
        </div>
      </div>
      <div class="it-extra-parameters">
        <div class="it-extra-parameters__fields" it-program-options>
          <div class="form-group" it-for-input>
            <label it-label></label>
            <span it-replacewith-input class="form-control"></span>
          </div>
          <div class="form-group" it-for-checkbox>
            <label it-label>
              <span it-replacewith-input></span>
            </label>
          </div>
        </div>

        <div class="it-extra-parameters__confirm">
          <span class="it-extra-parameters__price"><span it-show-sum="show.extraParameters.sum"></span> руб.</span>
          <button class="it-extra-parameters__order btn btn-success pull-right" type="button"
                  it-forward>
            Заказать
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="it-calculation">
    <div class="it-calculation__highlight">
      Расчет <span class="it-calculation__number">№
            <span it-show="calculation.id"></span>
          </span>
    </div>

    <div class="it-calculation__note"> Для быстрого
      заказа или консультации сообщите № расчета нашим специалистам
    </div>

    <div class="it-calculation__email">
      <div class="form-inline text-right">
        <div class="form-group">
          <input it-notification-email placeholder="email@example.com" type="text" class="form-control">
        </div>
        <div class="form-group">
          <button type="button" class="btn btn-warning "
                  it-notification-send>
            Отправить
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<div it-step="order">

  <form class="it-box it-box--padding" it-order-form>
    <div class="it-result-summary">
      <div class="it-result-summary__container">
        <div class="it-result-summary__details">
          <div><strong>Проверьте введенные данные:</strong></div>
          <div><span it-show="show.car_mark"></span> <span it-show="show.car_model"></span></div>
          <div><span it-show-format="calculation.car_cost"></span> р., <span
              it-show="calculation.car_manufacturing_year"></span> г.
          </div>
          <div it-show-drivers>
            <div>Возраст: <span it-age></span>,
              стаж: <span it-experience></span>,
              <span it-gender></span>
            </div>
          </div>
        </div>
        <div class="it-result-summary__credit">
          <div it-show-credit></div>
          <div it-show-warranty></div>
        </div>
      </div>
      <div class="it-result-summary__product">
        <p>Выбранный страховой продукт:</p>
        <h4 it-show="program.insurance_company.title"></h4>
      </div>
    </div>

    <div class="helper">
      <div class="row">

        <div class="col-sm-3">
          <div class="form-group">
            <label style="font-weight: bold" class="bold">Ваше имя</label>
            <input name="name" type="text" minlength="2" it-order-name required class="form-control">
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            <label style="font-weight: bold" class="bold">Контактный телефон</label>
            <input name="phone" minlength="10" type="text" it-order-phone required class="form-control">
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label style="font-weight: bold">Адрес доставки полиса КАСКО</label>
            <input type="text" name="address" required minlength="6" it-order-address class="form-control">
          </div>
        </div>

      </div>

      <div class="form-group">
        <label class="bold"><input type="radio" checked name="delivery" value="Премиум доставка (втечение 4х часов)"
                                   it-order-delivery> Премиум доставка (в
          течение 4х часов) - 600p</label>
      </div>

      <div class="form-group">
        <label><input type="radio" name="delivery" value="Бесплатная доставка (в течение 2х дней)" it-order-delivery>
          Бесплатная доставка (в течение 2х дней) -
          0р</label>
      </div>

      <div class="form-group">
        <label><input type="radio" name="delivery" value="Оформление в офисе" it-order-delivery> Оформление в офисе -
          0р</label>
      </div>

      <div class="form-group">
        <label><input type="checkbox" id="confirm" it-order-confirm> В день доставки у меня будут документы
          необходимые
          для оформления КАСКО</label>
      </div>

      <div class="text-right">
        <button class="btn btn-warning" type="submit" it-order-submit>Заказать</button>
      </div>
  </form>
</div>


</div>
</div>

<div class="it-preload">
  <div it-preload-insurance-logos></div>
  <img src="images/sprite.png">
</div>

<script>
  var form = kupikaskoForm([document.body]);
  form.moveForward();
</script>
</body>
</html>