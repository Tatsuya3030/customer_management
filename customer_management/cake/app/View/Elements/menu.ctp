					<ul class="nav pull-right">
						<li class="divider-vertical"></li>
						<li class="dropdown" id="syo5">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#syo5">
								５章
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><?php
									echo $this->Html->link(
										__('５－２：bakeを使った下準備'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '5',
											'r' => '2'
										)
									);
								?></li>
								<li><?php
									echo $this->Html->link(
										__('５－３：顧客一覧の表示'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '5',
											'r' => '3'
										)
									);
								?></li>
								<li><?php
									echo $this->Html->link(
										__('５－４：顧客情報の登録'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '5',
											'r' => '4'
										)
									);
								?></li>
								<li><?php
									echo $this->Html->link(
										__('５－５：顧客情報の更新'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '5',
											'r' => '5'
										)
									);
								?></li>
								<li><?php
									echo $this->Html->link(
										__('５－６：顧客情報の削除'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '5',
											'r' => '6'
										)
									);
								?></li>
								<li><?php
									echo $this->Html->link(
										__('５－７：顧客情報の検索・絞り込み'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '5',
											'r' => '7'
										)
									);
								?></li>
							</ul>
						</li>
						<li class="dropdown" id="syo6">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#syo6">
								６章
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><?php
									/** 6章 */
									echo $this->Html->link(
										__('６－１：売上一覧の表示'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '6',
											'r' => '1'
										)
									);
								?></li>
								<li><?php
									echo $this->Html->link(
										__('６－２：一覧のソート'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '6',
											'r' => '2',
										)
									);
								?></li>
								<li><?php
									echo $this->Html->link(
										__('６－３：一覧のページング'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '6',
											'r' => '3',
										)
									);
								?></li>
								<li><?php
									echo $this->Html->link(
										__('６－４：データの集計'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '6',
											'r' => '4',
										)
									);
								?></li>
							</ul>
						</li>
						<li class="dropdown" id="syo7">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#syo7">
								７章
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><?php
									echo $this->Html->link(
										__('７－１：ユーザ認証'),
										array(
											'controller' => 'users',
											'action' => 'logout',
											'l' => '7',
											'r' => '1',
										)
									);
								?></li>
								<li><?php
									echo $this->Html->link(
										__('７－２：データのインポート/エクスポート'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '7',
											'r' => '2',
										)
									);
								?></li>
								<li><?php
									echo $this->Html->link(
										__('７－３：全文検索'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '7',
											'r' => '3',
										)
									);
								?></li>
								<li><?php
									echo $this->Html->link(
										__('７－４：帳票出力'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '7',
											'r' => '4',
										)
									);
								?></li>
								<li><?php
									echo $this->Html->link(
										__('７－５：グラフの作成'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '7',
											'r' => '5',
										)
									);
								?></li>
							</ul>
						</li>
						<li class="dropdown" id="syo8">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#syo8">
								８章
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><?php
									echo $this->Html->link(
										__('８－１：Javascriptとの連携'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '8',
											'r' => '1',
										)
									);
								?></li>
								<li><?php
									echo $this->Html->link(
										__('８－２：AjaxとJSON'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '8',
											'r' => '2',
										)
									);
								?></li>
								<li><?php
									echo $this->Html->link(
										__('８－３：Twitter連携'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '8',
											'r' => '3',
										)
									);
								?></li>
								<li><?php
									echo $this->Html->link(
										__('８－４：Facebook連携'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '8',
											'r' => '4',
										)
									);
								?></li>
								<li><?php
									echo $this->Html->link(
										__('８－５：Google'),
										array(
											'controller' => 'customers',
											'action' => 'index',
											'l' => '8',
											'r' => '5',
										)
									);
								?></li>
							</ul>
						</li>
						<li class="divider-vertical"></li>
						<li><?php
						echo $this->Html->link(
							__('リセット'),
							array(
								'controller' => 'customers',
								'action' => 'index',
								't' => '1'
							)
						);
					?></li>
				</ul>
				</div><!-- /.nav-collapse -->
