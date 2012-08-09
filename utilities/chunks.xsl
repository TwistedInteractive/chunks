<xsl:stylesheet version="1.0"
				xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template match="*" mode="chunk">
		<xsl:choose>
			<xsl:when test="$chunks-logged-in = 'yes'">
				<div class="chunks-edit" style="outline: 1px dashed #ccc; position: relative; background: rgba(255, 255, 255, .25);">
					<a href="{$root}/symphony/publish/{../../section/@handle}/edit/{../@id}/?chunks" style="position: absolute; top: 5px; right: 5px;
						background: #fff; padding: 3px; border: 1px solid #ccc; border-radius: 3px; color: #000; font-size: 12px; line-height: 12px;
						text-decoration: none; box-shadow: 0px 1px 2px rgba(0, 0, 0, .5);" onclick="window.open(this.href, '_blank', 'width=800,height=500,location=no,menubar=no,status=no'); return false;">edit</a>
					<xsl:apply-templates select="*" mode="html" />
				</div>
			</xsl:when>
			<xsl:otherwise>
				<xsl:apply-templates select="*" mode="html" />
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>

</xsl:stylesheet>