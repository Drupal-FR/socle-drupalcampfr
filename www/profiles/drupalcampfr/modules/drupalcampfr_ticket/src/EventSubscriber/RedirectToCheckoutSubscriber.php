<?php

namespace Drupal\drupalcampfr_ticket\EventSubscriber;

use Drupal\commerce_cart\Event\CartEntityAddEvent;
use Drupal\commerce_cart\Event\CartEvents;
use Drupal\commerce_order\Entity\OrderInterface;
use Drupal\Core\Routing\TrustedRedirectResponse;
use Drupal\Core\Url;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class RedirectCartSubscriber.
 */
class RedirectToCheckoutSubscriber implements EventSubscriberInterface {

  /**
   * The request stack.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * RedirectCartSubscriber constructor.
   *
   * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack
   *   The request stack.
   */
  public function __construct(RequestStack $requestStack) {
    $this->requestStack = $requestStack;
  }

  /**
   * Sends to checkout process.
   *
   * @param \Drupal\commerce_cart\Event\CartEntityAddEvent $event
   *   The cart event.
   */
  public function onProductAdded(CartEntityAddEvent $event) {
    $this->requestStack->getCurrentRequest()->attributes->set('_checkout_redirect_cart', $event->getCart());
  }

  /**
   * Checks if a redirect rules action was executed.
   *
   * Redirects to the provided url if there is one.
   *
   * @param \Symfony\Component\HttpKernel\Event\FilterResponseEvent $event
   *   The response event.
   */
  public function checkRedirectIssued(FilterResponseEvent $event) {
    $request = $event->getRequest();
    $cart = $request->attributes->get('_checkout_redirect_cart');
    if (isset($cart) && $cart instanceof OrderInterface) {
      $url = Url::fromRoute('commerce_checkout.form', ['commerce_order' => $cart->id()]);
      $response = new TrustedRedirectResponse($url->toString());
      $response->addCacheableDependency($cart);
      $event->setResponse($response);
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events = [
      CartEvents::CART_ENTITY_ADD => ['onProductAdded', 1000],
      KernelEvents::RESPONSE => ['checkRedirectIssued', -10],
    ];
    return $events;
  }

}
