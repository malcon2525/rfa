<form action="index.php?pag=conteudo-cad" method="post" enctype="multipart/form-data">
        			<? $usuario_id = $_SESSION['secao_usuario']['id']; ?>
			    	<input type="hidden" name="menu_id" id="menu_id" value="<?=$menu_id?>">
			    	<input type="hidden" name="usuario_id" id="usuario_id" value="<?=$usuario_id?>">
			    	<input type="hidden" name="id" id="id" value="<?=$id?>">
        	
        	
			<div class="form-row">
			    <div class="form-group col-md-10">
			      <label for="titulo">titulo </label>
     	          <input class="form-control" type="text" name="titulo" id="titulo" value="<?=$titulo?>" required="" onkeyup="generateURL()">
			    </div>
			    <div class="form-group col-md-2">
			      <? $checked = ($situacao=="on"  ? 'checked' : '' )  ?>
			      <label for="situacao">Situação </label>
			      <input class="form-control" type="checkbox" maxlength="25" name="situacao" id="situacao" <?=$checked?> data-toggle="toggle" data-on="Ativado"  data-off="Desativado" data-onstyle="success" data-offstyle="danger"  >
			    </div>
			</div>
			

			<div class="form-row">	
				<div class="form-group">	
					
					<label for="conteudo">conteudo</label>
			            <textarea name="conteudo" id="conteudo" rows="10" cols="80">
			                <?=$conteudo?>
			            </textarea>
			            <script>
			                // Replace the <textarea id="conteudo"> with a CKEditor
			                // instance, using default configuration.
			                CKEDITOR.replace( 'conteudo' );
			            </script>

			            
			        </div>			
			</div>			

			<div class="form-row">	
				<div class="form-group col-md-10">
					<label for="chamada">Chamada</label><span id="faltaCH" class="caracteres-restantes"> 150</span>  <span class="caracteres-restantes">caracteres restantes</span>
					<textarea class="form-control" id="chamada" name="chamada" rows="3" maxlength="150" onkeyup="validaCampo('chamada', 'faltaCH', 150)"><?=$chamada?></textarea>
				</div> 
				<div class="form-group col-md-2 ">	
					<label for="gerar_chamada">&nbsp</label>
					<button type="button" class="btn btn-info d-flex pt-3 pb-3 " id="gerar_chamada" data-toggle="tooltip" data-placement="left" title="Pega os 150 primeiros caracteres do conteúdo."> Gerar <br> automático </button>
				</div>
			</div>	

			
			<div class="form-row">	
				<div class="form-group col-md-6">
					<label for="conteudo_localizacao_id">	O Conteúdo será destacado na Página Inicial?</label>
					<?
					//  combro(tabela, nome da tag option, valor exibido na tela, valor que está gravado no bcom)
						combo('conteudo_localizacao', 'conteudo_localizacao_id', 'descricao', $conteudo_localizacao_id, 'WHERE id=1 OR id=9');
					?>


				</div>
				<!-- <div class="form-group col-md-6">	
				  <label for="codigo_produto">	Código do Produto</label>
				  <input type="text" name="codigo_produto" id="codigo_produto" class="form-control" value="<?=$codigo_produto?>">
				</div>  -->

			</div>	

			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="foto_reduzida">Foto Reduzida (370x264) - <?=$foto_reduzida?></label>
					<input class="form-control-file" type="file" id="foto_reduzida" name="foto_reduzida" class="file_upload" value="<?=$foto_reduzida?>" >
					
				</div>
				<div class="form-group col-md-6">	
					<label for="alt_foto_reduzida">	SEO: - Foto reduzida </label>
					<input type="text" name="alt_foto_reduzida" id="alt_foto_reduzida" class="form-control" value="<?=$alt_foto_reduzida?>" >
				</div>
			</div>

			<div class="grupo-campo">
			<div class="form-row">


				<div class="form-group col-md-12">
					<label for="title">	SEO: Title: </label><span id="faltat" class="caracteres-restantes"> 60</span>  <span class="caracteres-restantes">caracteres restantes</span> 


					    <div class="input-group">
					      <input onkeyup="validaCampo('title', 'faltat', 60)" type="text" name="title" id="title" class="form-control" maxlength="60" value="<?=$title?>">
					      <span class="input-group-btn">
					        <button class="btn btn-secondary" type="button" id="gerar_titulo" data-placement="left"  data-toggle="tooltip" title="Pega os 60 primeiros caracteres do titulo.">Gerar</button>
					      </span>
					    </div>
					
				</div>

				<div class="form-group col-md-12">
					<label for="uri">	SEO: URI </label>
     				 <input type="text" name="uri" id="uri" class="form-control" value="<?=$uri?>">
				</div>

				<div class="form-group col-md-12">
					<label for="description">SEO - Descriprion:  </label>
					<span id="falta" class="caracteres-restantes"> 150</span>  <span class="caracteres-restantes">caracteres restantes</span> 
				    <textarea class="form-control" id="description" rows="3" name="description" maxlength="150"  onkeyup="validaCampo('description', 'falta', 150)" ><?=$description?></textarea>
				    

				</div>
			</div>
			</div>
			






			<!-- cadastro de fotos do conteudo -->
			
<!--
			<div id="sessao_foto" class="grupo-campo">

					<div class="form-group col-md-12">
						<label for="foto">Fotos do Produto (830X540)</label>
						<input class="form-control-file" type="file" id="foto" name="foto[]" class="file_upload" value="oi" multiple>
						
					</div>

-->

					<!-- lista de imagens -->
<!--
					<iframe src="<?//=BASE?>/adm/galeria-foto-conteudo-lista.php?conteudo_id=<?//=$alterar?>" height="210" width="765" style="border: 0px"></iframe>

			</div>
-->

			<!-- fim do cadastro de fotos do conteudo -->










        	<div class="d-flex justify-content-end " >
	        	<button type="button" name="voltar" value="voltar" class="btn btn-secondary mr-2" onclick="window.location = 'index.php?pag=menu-lista'">Voltar</button>
	        	<button type="submit" name="enviar" value="enviar" class="btn btn-primary">
	        		<?
	        		$tituloBotao = (empty($alterar) ? 'Gravar' : 'Alterar');
	        		echo $tituloBotao;
	        		?>
	        	</button>
		    </div> 

        </form>
