<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class PurchaseSuccessful
 *
 * This event is triggered when a purchase is successfully completed. 
 * It encapsulates the relevant data pertaining to the purchase, 
 * allowing other parts of the application to respond accordingly (e.g., 
 * sending notifications, updating records, broadcasting messages).
 *
 * The event can be broadcasted on a specified channel, enabling real-time 
 * updates to clients connected to the application.
 *
 * Usage:
 * To dispatch this event, use the `event()` helper function in the 
 * appropriate controller or service after processing a successful 
 * purchase.
 *
 * Example:
 * ```
 * event(new PurchaseSuccessful($email, $productId, $safaricomResponse));
 * ```
 *
 * Properties:
 * - `$email`: The email address of the user who made the purchase.
 * - `$productId`: The ID of the purchased product.
 * - `$safaricomResponse`: The response received from Safaricom's payment API.
 *
 * Channels:
 * This event is broadcasted on the 'purchase-success' channel, which 
 * allows front-end applications to listen for successful purchases 
 * and react accordingly.
 *
 * @package App\Events
 */
class PurchaseSuccessful
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The email address of the user who made the purchase.
     *
     * @var string
     */
    public $email;

    /**
     * The ID of the purchased product.
     *
     * @var int
     */
    public $productId;

    /**
     * The response received from Safaricom's payment API.
     *
     * @var mixed
     */
    public $safaricomResponse;

    /**
     * Create a new event instance.
     *
     * @param string $email The email address of the user.
     * @param int $productId The ID of the product purchased.
     * @param mixed $safaricomResponse The response from Safaricom's API.
     */
    public function __construct(string $email, int $productId, $safaricomResponse)
    {
        $this->email = $email;
        $this->productId = $productId;
        $this->safaricomResponse = $safaricomResponse;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel> An array of channels for broadcasting.
     */
    public function broadcastOn()
    {
        return [
            new Channel('purchase-success'), // Public channel for successful purchases
        ];
    }
}