INSERT INTO `#__redshop_mail` (`mail_name`, `mail_subject`, `mail_section`, `mail_order_status`, `mail_body`, `published`, `mail_bcc`) VALUES
('Stockroom Status Mail', 'Stockroom Status Mail', 'admin_notify_stock_mail', '0', '<table>\r\n  <tbody>\r\n  <tr>\r\n 	 <td colspan="4">Hello Administrator,</td>\r\n  </tr>\r\n  <tr>\r\n  	<td colspan="4">The following product/s have reached minimum stock level.</td>\r\n  </tr>\r\n  <tr>\r\n    <td colspan="4">\r\n      <table border="1">\r\n      <tbody>\r\n        <tr>\r\n          <td>Product Number</td>\r\n          <td>Product Name</td>\r\n          <td>Stockroom Name</td>\r\n          <td>Current Stock</td>\r\n        </tr>\r\n        <!--  {product_loop_start} -->\r\n        <tr>\r\n          <td>{product_number}\</td>\r\n          <td>{product_name}</td>\r\n          <td>{stockroom_name}</td>\r\n          <td>{stock_status}</td>\r\n        </tr>\r\n        <!--  {product_loop_end} -->\r\n      </tbody>\r\n      </table>\r\n    </td>\r\n  </tr>\r\n  <tr>\r\n  	<td colspan="4">Regards,</td>\r\n  </tr>\r\n  <tr>\r\n  	<td colspan="4">Stockkeeper</td>\r\n  </tr>\r\n  </tbody>\r\n</table>', 1, '');